<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Models\Price;
use App\Models\Category;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'catalog', 'show');
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

        if (Auth::user() && Auth::user()->id != $tshirt->customer_id && $tshirt->customer_id != NULL) 
            abort(404);
        $price = Price::all()->first();
        $color= Color::all();

        return view('tshirts.show',compact('tshirt','price','color'));
    }
}
