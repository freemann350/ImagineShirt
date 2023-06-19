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
    public function index()
    {
        return view('home');
    }

    public function catalog(): View
    {
        $allTshirt_images = Tshirt::all(); 
        return view('tshirts.index')->with('tshirt_images', $allTshirt_images);
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
}
