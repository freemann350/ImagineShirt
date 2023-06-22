<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Models\Price;
use App\Models\Category;
use App\Models\Color;
use Illuminate\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index(): View
    {
        return view('home');
    }

    public function catalog(): View
    {
        $tshirts = Tshirt::all();
    
        return view('tshirts.index', compact('tshirts'));
    }

    public function show($id): View
    {
        $tshirt = Tshirt::findOrFail($id);
        $category = Category::findOrFail($tshirt->category_id);
        $category = $category->name;
        $price = Price::all()->first();
        $color= Color::all();

        return view('tshirts.show',['tshirt'=> $tshirt, 'category'=>$category,'price'=>$price,'colors'=>$color]);
    }

    public function cart(): View
    {
        return view('cart.index');
    }
}
