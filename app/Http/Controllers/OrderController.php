<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangeOrderStatusRequest;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Storage;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showPending(Request $request): View
    {
        $filterByStatus = $request->status ?? '';
        $filterByName = $request->name ?? '';
        $filterByDateStart = $request->startDate ?? '';
        $filterByDateEnd = $request->endDate ?? '';
        $filterByNIF = $request->nif ?? '';

        $pendingQuery = Order::query(); 

        if ($filterByStatus != '') {
            $pendingQuery->where('status',$filterByStatus);
        }

        if ($filterByName !== '') {
            $userIds = User::where('name', 'like', "%$filterByName%")->pluck('id');
            $pendingQuery->whereIntegerInRaw('customer_id', $userIds);
        }

        if ($filterByDateStart != '') {
            if (!isset($request->endDate)){
                 $filterByDateEnd = date('Y-m-d');
            }

            $pendingQuery->whereBetween('date',[$filterByDateStart,$filterByDateEnd]);

        }

        if ($filterByNIF != '') {
            $pendingQuery->where('nif','like',"%$filterByNIF%");
        }

        $pendingQuery->where('status','pending');
        $pendingQuery->orWhere('status','paid');
        $orderPending = $pendingQuery->paginate(20);
        
        return view('management.orders.pending-orders',compact('orderPending','filterByStatus','filterByName','filterByDateStart','filterByDateEnd','filterByNIF'));
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

        if ($filterByName !== '') {
            $userIds = User::where('name', 'like', "%$filterByName%")->pluck('id');
            $historyQuery->whereIntegerInRaw('customer_id', $userIds);
        }

        if ($filterByDateStart != '') {
            if (!isset($request->endDate)){
                 $filterByDateEnd = date('Y-m-d');
            }

            $historyQuery->whereBetween('date',[$filterByDateStart,$filterByDateEnd]);

        }

        if ($filterByNIF != '') {
            $historyQuery->where('nif','like',"%$filterByNIF%");
        }

        $orderHistory = $historyQuery->paginate(20);

        return view('management.orders.order-history',compact('orderHistory','filterByStatus','filterByName','filterByDateStart','filterByDateEnd','filterByNIF'));
    }

    public function changeStatus(ChangeOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->status = $request->validated()['status'];

        $order->save();

        if ($order->status == 'paid') {
            $strMsg = ' is now paid!' ;
            $this->createSendPDF($order->id,$order->customer_id);
        } elseif ($order->status == 'closed') {
            $strMsg = ' is now closed!' ;
            $this->sendClosed($order->id,$order->customer_id);
        }
        
        return back()
            ->with('alert-msg', 'Order #' . $order->id . $strMsg)
            ->with('alert-type', 'success');
    }

    public function show($id): View
    {
        $orderQuery = Order::findOrFail($id); 

        $orderItemQuery = OrderItem::where('order_id',$id)->paginate(20); 

        return view('management.orders.show')->with([
            'name'=>$orderQuery->user->name,
            'address'=>$orderQuery->address,
            'nif'=>$orderQuery->nif,
            'id'=>$orderQuery->id,
            'date'=>$orderQuery->date,
            'pdf'=>$orderQuery->receipt_url,
            'status'=>$orderQuery->status,
            'total'=>$orderQuery->total_price,
            'orderItems'=>$orderItemQuery
        ]);
    }

    private function createSendPDF($order_id, $user_id) 
    {
        $orderQuery = Order::findOrFail($order_id);
        $orderItemQuery = OrderItem::where('order_id',$order_id)->get();
        
        $user = User::findOrFail($user_id);
        $data= [
            'name'=>$orderQuery->user->name,
            'address'=>$orderQuery->address,
            'nif'=>$orderQuery->nif,
            'id'=>$orderQuery->id,
            'date'=>$orderQuery->date,
            'total'=>$orderQuery->total_price,
            'orderItems'=>$orderItemQuery
        ];
        
        view()->share('orderItem',$data);
        $pdf = Pdf::loadView('receipt_table',$data);
        
        $filename = "Order_$order_id.pdf";
        
        DB::transaction(function () use ($orderQuery,$filename) 
        {
            $orderQuery->receipt_url = $filename;
            $orderQuery->save();
        });

        $content = $pdf->download('pdf_file.pdf');
        Storage::put("pdf_receipts/$filename",$content) ;
        
        $dataEmail["email"] = $user->email;
        $dataEmail["title"] = "Order #$order_id";
    
        $file = storage_path("/app/pdf_receipts//$filename");
        
        Mail::send('mail-body', $data, function($message) use($dataEmail, $file) {
            $message->to($dataEmail["email"])->subject($dataEmail["title"]);
            $message->attach($file);
        });

        return;
    }

    private function sendClosed($order_id, $user_id) 
    {
        $user = User::findOrFail($user_id);
        $orderItemQuery = OrderItem::where('order_id',$order_id);
        $orderQuery = Order::findOrFail($order_id);

        $data= [
            'name'=>$orderQuery->user->name,
            'address'=>$orderQuery->address,
            'nif'=>$orderQuery->nif,
            'id'=>$orderQuery->id,
            'date'=>$orderQuery->date,
            'total'=>$orderQuery->total_price,
            'orderItems'=>$orderItemQuery
        ];


        $dataEmail["email"] = $user->email;
        $dataEmail["title"] = "Order #$order_id was closed";

        Mail::send('mail-body-closed', $data, function($message) use($dataEmail) {
            $message->to($dataEmail["email"])->subject($dataEmail["title"]);
        });
    }
}
