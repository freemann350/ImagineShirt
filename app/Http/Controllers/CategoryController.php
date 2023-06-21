<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $filterByName = $request->name ?? '';

        $categoryQuery = Category::query(); 

        if ($filterByName != '') {
            $categoryQuery->where('name','like',"%$filterByName%");
        }

        $categories = $categoryQuery->paginate(20); 

        return view('management.categories.index',compact('categories','filterByName'));
    }

    public function create() : View{
        return view('management.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse 
    {
        $formData = $request->validated();

        $category = DB::transaction(function () use ($formData) {
            $newCategory = new Category();

            $newCategory->name = $formData['name'];
            $newCategory->save();

            return $newCategory;
        });

        $htmlMessage = "Category <strong>\"{$category->name}\"</strong> succesfully created!";
        return redirect()->route('categories.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type', 'success');
    }

    public function edit($id): View
    {
        $categories = Category::findOrFail($id); 
        
        return view('management.categories.edit')->with(['category'=> $categories]);
    }

    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $formData = $request->validated();

        $category = DB::transaction(function () use ($formData, $category) {
            $category->name = $formData['name'];
            
            $category->update();
            return $category;
        });
            
        $htmlMessage = "Category <strong>\"{$category->name}\"</strong> successfully updated!";

        return redirect()->route('categories.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','success');
    }

    public function destroy(Category $category): RedirectResponse 
    {
       $htmlMessage = "Category <strong>\"{$category->name}\"</strong> has been deleted!"; 
       $category->delete();
        return redirect()->route('categories.index')
        ->with('alert-msg', $htmlMessage)
        ->with('alert-type','warning');
    }
}
