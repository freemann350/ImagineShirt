<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
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
        $orderPending = $queryPending->paginate(10);
        return view('management.pending-orders')->with('orderPending', $orderPending);
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
