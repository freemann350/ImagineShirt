<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Models\Price;
use App\Models\Category;
use App\Models\Color;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'cart', 'catalog', 'show');
    }

    public function index(): View
    {
        return view('home');
    }

    public function catalog(Request $request): View
    {
        $filterByCategory = $request->category ?? '';
        $filterByName = $request->name ?? '';
        $tshirtsQuery = Tshirt::query();
    
        if ($filterByCategory != '') {
            $tshirtsQuery->where('category_id',$filterByCategory);
        }

        if ($filterByName != '') {
            $tshirtsQuery->where('name','like',"%$filterByName%");
        }

        $tshirtsQuery->where('category_id', "IS NOT", NULL);

        $tshirts = $tshirtsQuery->paginate(20);
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
