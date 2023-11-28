<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category',
            'categories' => Category::withCount('products')->orderBy('name', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create', [
            'title' => 'Category',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = $request->validate([
            'name' => ['required', 'max:255', 'unique:categories'],
        ]);

        Category::create($category);
        $request->session()->flash('success', 'Add category success.');
        return redirect('/dashboard/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'title' => 'Category',
            'category' => $category,
            'products' => Product::withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->where('category_id', $category->id)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', [
            'title' => 'Category',
            'categories' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $rules = [];
        if ($request->name != $category->name) {
            $rules['name'] = ['required', 'max:255', 'unique:categories'];
        }

        $dataNew = $request->validate($rules);

        Category::where('id', $category->id)->update($dataNew);

        return redirect('/dashboard/categories/' . $request->id)->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
