<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class UserController extends Controller
{
  
    public function index(): View
    {
        return view('management.index');
    }

    public function users(Request $request): View
    {
        $users = User::query()->paginate(10); 
        return view('management.users.index')->with('users', $users);
    }

    public function usersEdit(Request $request): View
    {
        $users = User::query()->paginate(10); 
        return view('management.users.edit')->with('users', $users);
    }

    public function statistic(): View
    {
        $querySalesEvo = DB::select('
            SELECT MONTHNAME(date) AS mnt, COUNT(id) AS cnt
            FROM orders
            WHERE status = "closed" AND date>now()  - INTERVAL 12 month 
            GROUP BY MONTHNAME(date)
            ORDER BY date;
        ');

        $querySalesPerCat = DB::select('
            SELECT categories.name as name, sum(qty) as qty
            FROM order_items
            INNER JOIN tshirt_images ON tshirt_images.id = order_items.tshirt_image_id
            INNER JOIN categories ON categories.id = tshirt_images.category_id
            INNER JOIN orders ON orders.id = order_items.order_id
            WHERE orders.date>now()  - INTERVAL 12 month
            GROUP BY categories.name
            ORDER BY categories.name;
        ');

        /*$queryTodaySales = DB::select('
            SELECT ,, ,
            FROM orders
            INNER JOIN users ON users.id = orders.customer_id
            WHERE date=CURDATE();
        ');*/

        $today = date('Y-m-d');
        $queryTodaySales = DB::table('orders')
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

        return view('management.statistics',['salesEvo'=>$querySalesEvo,'salesPerCat'=>$querySalesPerCat, 'todaySales'=>$queryTodaySales],['totalToday'=>$totalToday]);
    }

}
