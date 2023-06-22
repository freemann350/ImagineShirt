<?php

namespace App\Http\Controllers;

use App\Http\Requests\PriceRequest;
use App\Models\Price;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PriceController extends Controller
{
    public function index(Request $request): View
    {
        $price = Price::all()->first();
        return view('management.prices.index',compact('price'));
    }

    public function update(PriceRequest $request, Price $price): RedirectResponse
    {
        $formData = $request->validated();

        $tshirt = DB::transaction(function () use ($formData, $price) {
            $price->unit_price_catalog = $formData['unit_price_catalog'];
            $price->unit_price_own = $formData['unit_price_own'];
            $price->unit_price_catalog_discount = $formData['unit_price_catalog_discount'];
            $price->unit_price_own_discount = $formData['unit_price_own_discount'];
            $price->qty_discount = $formData['qty_discount'];
            
            $price->save();

            return $price;
        });
            
        $htmlMessage = "Price information successfully updated!";

        return redirect()->route('prices.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }
}
