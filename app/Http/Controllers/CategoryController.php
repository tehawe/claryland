<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index', [
            'title' => 'Category',
        ]);
    }

    public function data()
    {
        return view('dashboard.categories.data', [
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
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255|unique:categories',
            ],
            [
                'name.required' => 'Name can not be empty',
                'name.max' => 'Name max is 255 characters',
                'name.unique' => 'Name is already taken'
            ]
        );
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors(),
            ]);
        } else {
            $category = [
                'name' => $request->name,
                'description' => $request->description,
            ];
            Category::create($category);
            return response()->json([
                'success' => 'Add new category success'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('dashboard.categories.show', [
            'title' => 'Category',
            'category' => $category,
            'name' => $category->name,
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
            'category' => $category,
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function remove(Category $category)
    {
        return view('dashboard.categories.remove', [
            'title' => 'Category',
            'category' => $category,
        ]);
    }

    public function destroy(Category $category)
    {
        $category = Category::findOrFail($category->id);
        $category->delete();
    }
}
