<?php

namespace App\Http\Controllers;

use App\Http\Requests\TshirtRequest;
use App\Models\Category;
use App\Models\Tshirt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TshirtController extends Controller
{
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';
        $filterByCategory = $request->category ?? '';

        $tshirtQuery = Tshirt::query(); 

        if ($filterByName != '') {
            $tshirtQuery->where('name','like',"%$filterByName%");
        }
        
        if ($filterByCategory != '') {
            $userIds = Category::where('name', 'like', "%$filterByCategory%")->pluck('id');
            $tshirtQuery->whereIntegerInRaw('category_id', $userIds);
        }

        
        $tshirts = $tshirtQuery->paginate(20); 

        return view('management.tshirts.index',compact('tshirts','filterByName','filterByCategory'));
    }

    public function create() : View{
        $categories = Category::all();

        return view('management.tshirts.create',compact('categories'));
    }

    public function store(TshirtRequest $request): RedirectResponse 
    {
        $formData = $request->validated();

        $tshirt = DB::transaction(function () use ($formData, $request) {
            $newTshirt = new Tshirt();

            $newTshirt->name = $formData['name'];
            $newTshirt->category_id = $formData['category'];
            $newTshirt->description = $formData['description'];
            $path = $request->tshirt_image->store('public/tshirt_images');
            $newTshirt->image_url = basename($path);
            $newTshirt->save();

            return $newTshirt;
        });
        $htmlMessage = "Tshirt <strong>\"{$tshirt->name}\"</strong> succesfully created!";
        return redirect()->route('tshirts.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', 'success');
    }

    public function edit($id): View
    {
        $tshirt = Tshirt::findOrFail($id);
        $categories = Category::all();

        if ($tshirt->category_id == NULL){
            abort(404);
        }
        
        return view('management.tshirts.edit',compact('tshirt','categories'));
    }

    public function update(TshirtRequest $request, Tshirt $tshirt): RedirectResponse
    {
        $formData = $request->validated();

        $tshirt = DB::transaction(function () use ($formData, $tshirt, $request) {
            $tshirt->name = $formData['name'];
            $tshirt->description = $formData['description'];
            $tshirt->category_id = $formData['category'];
            
            $tshirt->save();

            if ($request->hasFile('tshirt_image')) {
                if ($tshirt->image_url) {
                    Storage::delete('public/tshirt_images/' . $tshirt->image_url);
                }
                
                $path = $request->tshirt_image->store('public/tshirt_images');
                $tshirt->image_url = basename($path);
                $tshirt->save();
            }
            
            return $tshirt;
        });
            
        $htmlMessage = "Tshirt <strong>\"{$tshirt->name}\"</strong> successfully updated!";

        return redirect()->route('tshirts.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }

    public function destroy(Tshirt $tshirt): RedirectResponse 
    {
       $htmlMessage = "Tshirt <strong>\"{$tshirt->name}\"</strong> has been deleted!"; 
       $tshirt->delete();

        return redirect()->route('tshirts.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','warning');
    }

    public function getPrivateFile($filename)
    {
        return response()->download(storage_path("tshirt_images_private/$filename"), null, [], null);
    }
}
