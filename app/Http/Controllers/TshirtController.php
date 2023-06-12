<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use Illuminate\View\View;
use Illuminate\Http\Request;

class TshirtController extends Controller
{

    public function index(): View
    {
        $allTshirt_images = Tshirt::all(); 
        return view('shop')->with('tshirt_images', $allTshirt_images);
    }
}
