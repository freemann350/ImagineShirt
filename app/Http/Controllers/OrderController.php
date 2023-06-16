<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Order::class, 'orders');
    }

    public function index(): View
    {
        return view('management.index');
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

        return view('management.statistics',['salesEvo'=>$querySalesEvo,'salesPerCat'=>$querySalesPerCat]);
    }

    public function showPending(Request $request): View
    {
        $allOrders = Order::all(); 
        return view('management.pending-orders')->with('order', $allOrders);
    }

    public function showHistory(Request $request): View
    {
        $filterByStatus = $request->status ?? '';
        $filterByName = $request->name ?? '';
        $filterByDateStart = $request->startDate ?? '';
        $filterByDateEnd = $request->endDate ?? '';
        $filterByNIF = $request->nif ?? '';

        $historyQuery = Order::query();

        if ($filterByStatus != '') {
            $historyQuery->where('status',$filterByStatus);
        }

        if ($filterByName != '') {
            $historyQuery->where('name',$filterByName);
        }

        if ($filterByDateStart != '' &&  $filterByDateEnd != '') {
            $historyQuery->where('date',$filterByStatus);
        }

        if ($filterByNIF != '') {
            $historyQuery->where('nif',$filterByNIF);
        }
        
        $history = $historyQuery->paginate(10);

        return view('management.order-history')->with('orderHistory', $history);
    }

}
