<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeAdminRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AdminController extends Controller
{
    public function home(): View
    {
        return view('management.index');
    }

    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';
        $filterByEmail = $request->email ?? '';
        $filterByUserType = $request->user_type ?? '';
        $filterByBlocked = $request->blocked ?? '';

        $userQuery = User::query(); 

        if ($filterByName != '') {
            $userQuery->where('name','like',"%$filterByName%");
        }

        if ($filterByEmail !== '') {
            $userQuery->where('email', $filterByEmail);
        }

        if ($filterByUserType != '') {
            $userQuery->where('user_type',$filterByUserType);
        }

        if ($filterByBlocked != '') {
            $userQuery->where('blocked',$filterByBlocked);
        }

        $users = $userQuery->paginate(20); 

        return view('management.users.index',compact('users','filterByName','filterByEmail','filterByUserType','filterByBlocked'));
    }

    public function edit($id): View
    {
        $users = User::findOrFail($id); 
        
        return view('management.users.edit')->with(['user'=> $users]);
    }

    public function create() : View{

        return view('management.users.create');

    }
    public function store(UserRequest $request): RedirectResponse 
    {
        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData) {
            $newUser = new User();

            $newUser->name = $formData['name'];
            $newUser->user_type = $formData['user_type'];
            $newUser->email = $formData['email'];
            $newUser->password = $formData['password'];
            $newUser->password = Hash::make($formData['password']);
            $newUser->save();

            return $newUser;
        });

        $htmlMessage = "User <strong>\"{$user->name}\"</strong> succesfully created!";
        return redirect()->route('users.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', 'success');
    }
    
    public function update(UserRequest $request, User $user): RedirectResponse
    {
        //$user = User::findOrFail($id);

        $formData = $request->validated();

        $user = DB::transaction(function () use ($formData, $user) {
            $user->name = $formData['name'];
            $user->user_type = $formData['user_type'];
            $user->email = $formData['email'];
            $user->blocked = $formData['blocked'];
            if (isset($formData['password'])) {
                $user->password = Hash::make($formData['password']);
            }
            
            $user->update();
            return $user;
        });
            
        $htmlMessage = "User <strong>\"{$user->name}\"</strong> successfully updated!";

        return redirect()->route('users.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
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

    public function changeBlock(ChangeAdminRequest $request, User $user): RedirectResponse 
    {
        $user->blocked = $request->validated()['blocked'];
        $user->save();
        $strMsg = $user->blocked ? '" is now blocked!' : '" is now unblocked!';
        
        return back()
            ->with('alert-msg', 'User "' . $user->name . $strMsg)
            ->with('alert-type', $user->blocked ? 'warning' : 'success');
    }

    public function destroy(User $user): RedirectResponse 
    {
       $user->delete();
        return redirect()->route('users.index');
    }
}
