<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.products.index')->with(['title' => 'Products']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create', [
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'max:255', 'unique:products'],
            'price' => ['required', 'min:0'],
            'category_id' => ['required'],
        ]);

        Product::create($data);
        return response()->json(['success', 'Add new product success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $data = Product::where('id', $product->id)->withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->first();

        return view('dashboard.products.show')->with(['title' => 'Product', 'product' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('dashboard.products.edit', [
            'title' => 'Product',
            'product' => $product,
            'categories' => Category::orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'price' => ['required', 'min:0'],
            'category_id' => ['required'],
        ];
        if ($request->name != $product->name) {
            $rules['name'] = ['required', 'max:255', 'unique:products'];
        }

        $dataNew = $request->validate($rules);
        Product::where('id', $product->id)->update($dataNew);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function data()
    {
        return view('dashboard.products.data', [
            'products' => Product::withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->get(),
        ]);
    }
}
