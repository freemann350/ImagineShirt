<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColorRequest;
use App\Models\Color;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ColorController extends Controller
{
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';

        $colorQuery = Color::query(); 

        if ($filterByName != '') {
            $colorQuery->where('name','like',"%$filterByName%");
        }

        $colors = $colorQuery->paginate(20); 

        return view('management.colors.index',compact('colors','filterByName'));
    }

    public function create() : View{
        return view('management.colors.create');
    }

    public function store(ColorRequest $request): RedirectResponse 
    {
        $formData = $request->validated();

        $color = DB::transaction(function () use ($formData) {
            $newColor = new Color();

            $newColor->code = $formData['code'];
            $newColor->name = $formData['name'];
            $newColor->save();

            return $newColor;
        });

        $htmlMessage = "Color <strong>\"{$color->name}\"</strong> succesfully created!";
        return redirect()->route('colors.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', 'success');
    }

    public function edit($code): View
    {
        $color = Color::findOrFail($code); 
        
        return view('management.colors.edit',compact('color'));
    }


    public function update(ColorRequest $request, Color $color): RedirectResponse
    {
        $formData = $request->validated();

        $color = DB::transaction(function () use ($formData, $color) {
            $color->name = $formData['name'];
            
            $color->update();
            return $color;
        });
            
        $htmlMessage = "Color <strong>\"{$color->name}\"</strong> successfully updated!";

        return redirect()->route('colors.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }

    public function destroy(Color $color): RedirectResponse 
    {
       $htmlMessage = "Category <strong>\"{$color->name}\"</strong> has been deleted!"; 
       $color->delete();
        return redirect()->route('colors.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','warning');
    }
}
