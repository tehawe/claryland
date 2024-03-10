<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function data(Product $product, Stock $stock)
    {
        return view('dashboard.products.stocks.data', [
            'stocks' => Stock::where('product_id', $product->id)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createStockIn(Product $product, Request $request)
    {
        return view('dashboard.products.stocks.create', [
            'stock' => 'in',
            'product' => $product,
        ]);
    }
    public function createStockOut(Product $product, Request $request)
    {
        return view('dashboard.products.stocks.create', [
            'stock' => 'out',
            'product' => $product,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Product $product, Request $request)
    {
        $rules = [
            'description' => 'required'
        ];
        if ($request->stock_in != '') {
            $rules['stock_in'] = 'min:0';
        }
        if ($request->stock_out != '') {
            $rules['stock_out'] = 'min:0';
        }

        $data = $request->validate($rules);
        $data['product_id'] = $product->id;
        Stock::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product, Stock $stock)
    {
        $data = Stock::where('id', $stock->id)->first();
        if ($data->stock_in != NULL) {
            $set = 'in';
        } else {
            $set = 'out';
        }
        return view('dashboard.products.stocks.edit', [
            'stock' => $set,
            'data' => $data,
            'product' => $product,
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, Stock $stock)
    {
        $rules = [
            'description' => 'required'
        ];
        if ($request->stock_in != '') {
            $rules['stock_in'] = 'min:0';
        }
        if ($request->stock_out != '') {
            $rules['stock_out'] = 'min:0';
        }

        $dataNew = $request->validate($rules);
        Stock::where('id', $stock->id)->update($dataNew);
        return back();
    }
    /**
     * Remove the specified resource from storage.
     */
    public function remove(Product $product, Stock $stock)
    {
        $data = Stock::where('id', $stock->id)->first();
        if ($data->stock_in != NULL) {
            $set = 'in';
        } else {
            $set = 'out';
        }
        return view('dashboard.products.stocks.remove', [
            'stock' => $set,
            'data' => $data,
            'product' => $product,
        ]);
    }

    public function destroy(Product $product, Stock $stock)
    {
        Stock::where('id', $stock->id)->delete();
        return back();
    }

    public function updateOrderStock(Order $order, Stock $stock)
    {
        $getOrder = Order::findOrFail($order->id);
        if (!$getOrder) {
            return response()->json(['error' => 'Order not found']);
        } else {
            $items = Item::where('order_id', $getOrder->id)->get();
            foreach ($items as $item) {
                $store = Stock::create([
                    'stock_out' => $item->qty,
                    'description' => $order->invoice,
                    'product_id' => $item->product_id,
                ]);
            }
        }

        if (!$getOrder->package_id) {
            return redirect()->route('orders.show', ['order' => $order->invoice]);
        } else {
            return redirect()->route('wa.gateway', ['order' => $order->invoice]);
        }
    }
}
