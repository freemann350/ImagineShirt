<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function addToCart($id){
        $product = Product::findorFail($id);

        $cart = session()->get('cart',[]);

        if(isset($cart[$id])){
            $cart[$id]['quantity']++;
        }else{
            $cart[$id] = [
                "product_name" => $product->product_name,
                "price" => $product->product_price,
                "quantity" => 1
            ];
        }

        session()->put('cart',$cart);
        return redirect()->back()->with('success','Product added to cart successfully!');
    }
}

