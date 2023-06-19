<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UserController extends Controller
{
  
    public function index(): View
    {
        return view('management.index');
    }

    public function users(Request $request): View
    {
        $users = User::query()->paginate(20); 
        return view('management.users.index')->with('users', $users);
    }

    public function userEdit($id): View
    {
        $users = User::findOrFail($id); 
        
        return view('management.users.edit')->with(['user'=> $users]);
    }

    public function update(UserRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);

        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData, $user) {
            $user->name = $formData['name'];
            $user->user_type = $formData['user_type'];
            $user->email = $formData['email'];
            $user->blocked = $formData['blocked'];
            if (isset($formData['password'])) {
                $user->password = $formData['password'];
            }
            
            $user->update();
            return $user;
        });
            
        return redirect()->route('users');
    }

    public function statistic(): View
    {
        $salesEvo = DB::select('
            SELECT MONTHNAME(date) AS mnt, COUNT(id) AS cnt
            FROM orders
            WHERE status = "closed" AND date>now()  - INTERVAL 12 month 
            GROUP BY MONTHNAME(date)
            ORDER BY date;
        ');

        $salesPerCat = DB::select('
            SELECT categories.name as name, sum(qty) as qty
            FROM order_items
            INNER JOIN tshirt_images ON tshirt_images.id = order_items.tshirt_image_id
            INNER JOIN categories ON categories.id = tshirt_images.category_id
            INNER JOIN orders ON orders.id = order_items.order_id
            WHERE orders.date>now()  - INTERVAL 12 month
            GROUP BY categories.name
            ORDER BY categories.name;
        ');

        $today = date('Y-m-d');
        $todaySales = DB::table('orders')
        ->join('users', 'users.id', '=', 'orders.customer_id')
        ->select('status', 'name', 'total_price', 'nif')
        ->where('orders.date',$today)
        ->paginate(10);
        
        $totalToday = DB::select('
            SELECT SUM(total_price) AS total
            FROM orders
            WHERE date = CURDATE()
            GROUP BY date
        ');

        return view('management.statistics',compact('salesEvo','salesPerCat','todaySales','totalToday'));
    }

}
