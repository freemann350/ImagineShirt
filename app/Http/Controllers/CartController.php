<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Price;
use App\Models\Tshirt;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('store');
    }

    public function show(): View {
        $cart = session('cart', []);
        
        count($cart) > 0 ? $price = Price::all()->first() : $price = 0;     
        $total = 0;
        return view('cart.index',compact('cart','price','total'));
    }

    public function addToCart(Request $request, Tshirt $tshirt) : RedirectResponse 
    {
        if ($tshirt->customer_id == NULL && $tshirt->category_id != NULL) 
        {
            $cart = session('cart', []);
            $cartKey = $tshirt->id . '' . $request->tshirt_color . '' . $request->tshirt_size;
            
            $tshirtSelf = $tshirt->category_id == NULL ?? 1;

            if (array_key_exists($cartKey, $cart)) {
                $cart[$cartKey]['tshirt_qty'] += $request->quantity;
            } else {
                $cart[$cartKey] = [
                    'tshirt_id' => $tshirt->id,
                    'tshirt_name' => $tshirt->name,
                    'tshirt_color' => $request->tshirt_color,
                    'tshirt_size' => $request->tshirt_size,
                    'tshirt_qty' => $request->quantity,
                    'tshirt_self' => $tshirtSelf,
                ];
            }
            
            $request->session()->put('cart', $cart);
        }

        return back();
    }

    public function removeFromCart(Request $request,$item): RedirectResponse
    {
        $cart = session('cart', []);
        
        if (array_key_exists($item, $cart)) {
            unset($cart[$item]);
        }

        $request->session()->put('cart', $cart);
        return back();
    }

    public function store(Request $request): RedirectResponse
    {
        $cart = session('cart', []);
        $total = count($cart);

        if ($total >= 1) {
            $customer = Auth::user();
            
            $price = Price::all()->first;
            $price = $price->unit_price_catalog;
            
            DB::transaction(function () use ($customer, $cart, $price) {
                $customer = Customer::find(Auth::user()->id);
                $newOrder = new Order();

                $newOrder->customer_id = Auth::user()->id;
                $newOrder->status = 'pending';
                $newOrder->date = date('Y-m-d');
                $newOrder->nif = $customer->nif;
                $newOrder->address = $customer->address;
                $newOrder->payment_type = $customer->default_payment_type;
                $newOrder->payment_ref = $customer->default_payment_ref;
                $newOrder->total_price = 0;
                $newOrder->save();

                $total = 0;

                foreach ($cart as $cart) {
                    $newOrderItem = new OrderItem();
                    $newOrderItem->order_id = $newOrder->id;
                    $newOrderItem->tshirt_image_id = $cart['tshirt_id'];
                    $newOrderItem->color_code = $cart['tshirt_color'];
                    $newOrderItem->size = $cart['tshirt_size'];
                    $newOrderItem->qty = $cart['tshirt_qty'];
                    $newOrderItem->unit_price = $price->unit_price_catalog;

                    $newOrderItem->sub_total = (float) $price->unit_price_catalog * (int) $cart['tshirt_qty'];
                    
                    $total += $newOrderItem->sub_total;
                    
                    $newOrderItem->save();
                }

                $newOrder->total_price = $total;
                $newOrder->save();
            });
        }
        return $this->destroy($request);
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back();
    }

    public function checkout(Request $request): View 
    {
        $cart = session('cart', []);
        $customer = Customer::find(Auth::user()->id);
        
        return view('cart.checkout', compact('cart', 'customer'));
    }
}
