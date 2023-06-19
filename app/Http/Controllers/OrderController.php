<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(Order::class, 'orders');
    }

    public function showPending(Request $request): View
    {
        $queryPending = Order::query(); 
        $queryPending->where('status','pending');
        $orderPending = $queryPending->paginate(20);
        return view('management.orders.pending-orders')->with('orderPending', $orderPending);
    }

    public function show($id): View
    {
        $orderQuery = Order::findOrFail($id); 

        $orderItemQuery = OrderItem::where('order_id',$id)->paginate(20); 

        return view('management.orders.show')->with([
            'name'=>$orderQuery->user->name,
            'address'=>$orderQuery->address,
            'id'=>$orderQuery->id,
            'date'=>$orderQuery->date,
            'status'=>$orderQuery->status,
            'total'=>$orderQuery->total_price,
            'orderItems'=>$orderItemQuery
        ]);
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
        
        $orderHistory = $historyQuery->paginate(20);

        return view('management.orders.order-history',compact('orderHistory'));
    }

}
