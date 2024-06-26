<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ProductNotInCollection;
use App\Models\Package;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use League\CommonMark\Node\Query\OrExpr;

class ItemController extends Controller
{
    public function productNotIn(Order $order): JsonResponse
    {
        $item = Item::where('order_id', $order->id)->get('product_id');;
        if ($order->package_id !== null) {
            $product = Product::whereNotIn('id', $item)->withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->get();
        } else {
            $product = Product::whereNotIn('id', $item)->whereNotIn('id', [1, 2])->withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->get();
        }
        return (new ProductNotInCollection($product))->response()->setStatusCode(201);
    }

    private function getProduct($id): Product
    {
        $product = Product::where('id', $id)->first();
        if (!$product) {
            throw new HttpResponseException(
                response()
                    ->json([
                        'errors' => [
                            'message' => ['Product not found'],
                        ],
                    ])
                    ->setStatusCode(404),
            );
        }
        return $product;
    }

    public function getItem(Order $order): ItemCollection
    {
        $item = Item::where('order_id', $order->id)->get();
        return new ItemCollection($item);
    }

    public function store(Request $request, Order $order): JsonResponse
    {
        $data = $request->all();

        $item = new Item($data);

        $product = $this->getProduct($request->product_id);
        $item->product_id = $product->id;

        if ($product->id == 1) {
            $package = Package::where('id', $order->package_id)->firstOrFail('price');
            $item->price = $package->price;
        } else {
            $item->price = $product->price;
        }

        $item->order_id = $order->id;
        $item->qty = 1;
        $item->save();

        return (new ItemResource($item))->response()->setStatusCode(201);
    }

    public function update(Request $request, Order $order, Item $item): ItemResource
    {
        // cek product_id form request
        if ($item->product_id == 2) {
            $ticketBermain = Item::where('order_id', $order->id)->where('product_id', 1)->first('qty');
            if ($request->qty > $ticketBermain->qty) {
                return new ItemResource($item);
            }
        }

        $data = Item::where('id', $item->id)->first();

        $data->qty = $request->qty;

        $product = Product::where('id', $item->product_id)->withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->first();
        $stock = $product->stocks_sum_stock_in - $product->stocks_sum_stock_out;

        if ($data->qty <= $stock) {
            $data->update();
            return new ItemResource($item);
        } else {
            $data->qty = $stock;
            $data->update();
            return new ItemResource($item);
        }
    }

    public function plus(Request $request, Order $order, Item $item): ItemResource
    {
        $ticketBermain = Item::where('order_id', $order->id)->where('product_id', 1)->first('qty');
        if ($item->product_id == 2) {
            if ($item->qty >= $ticketBermain->qty) {
                return new ItemResource($item);
            }
        }

        $data = Item::where('id', $item->id)->first();
        $data->qty = $data->qty + 1;

        $product = Product::where('id', $item->product_id)->withSum('stocks', 'stock_in')->withSum('stocks', 'stock_out')->first();
        $stock = $product->stocks_sum_stock_in - $product->stocks_sum_stock_out;

        if ($data->qty <= $stock) {
            $data->update();
            return new ItemResource($item);
        } else {
            return new ItemResource($item);
        }
    }

    public function min(Request $request, Order $order, Item $item): ItemResource
    {
        $data = Item::where('id', $item->id)->first();
        $data->qty = $data->qty - 1;
        $data->update();
        return new ItemResource($item);
    }

    public function delete(Order $order, Item $item): JsonResponse
    {
        $data = Item::findOrFail($item->id);
        if (!$data) {
            return response()->json([
                'errors' => 'data not found'
            ]);
        }
        $data->delete();

        return response()->json([
            'data' => 'Order ' . $order->invoice . ' with ID ' . $item->id,
            'action' => 'Delete',
            'status' => 'Succees'
        ])
            ->setStatusCode(200);
    }
}
