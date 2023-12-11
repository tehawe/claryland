<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductNotInCollection;
use App\Models\Order;
use App\Models\Package;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getOrder($invoice): Order
    {
        $order = Order::where('invoice', $invoice)->first();
        if (!$order) {
            throw new HttpResponseException(
                response()
                    ->json([
                        'errors' => [
                            'message' => ['Order not found'],
                        ],
                    ])
                    ->setStatusCode(404),
            );
        }
        return $order;
    }

    public function newInvoice()
    {
        $order = Order::whereDate('created_at', date('Y-m-d'))->get('invoice')->last();

        if (!$order) {
            $sequential = 1;
        } else {
            $sequential = substr($order->invoice, -6) + 1;
        }
        $newInvoice = 'CLO' . date('ymd') . Str::padLeft($sequential, 6, 0);
        return $newInvoice;
    }

    public function index()
    {
        return view('dashboard.transactions.orders.index', [
            'title' => 'Orders',
            'packages' => Package::where('status', 1)->get(),
            'invoice' => $this->newInvoice(),
            'pendingOrders' => Order::where('status', 0)->withSum('items', 'qty')->withSum('items', 'price')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create(Order $order)
    {
        $order = Order::where('invoice', $order->invoice)->first();
        //dd($order->invoice);
        return view('dashboard.transactions.orders.create', [
            'id' => $order->id,
            'invoice' => $order->invoice,
            'package' => Package::where('id', $order->package_id)->first('name'),
            'products' => Product::whereNotIn('id', Item::where('order_id', $order->id)->get('product_id'))->get(),
            'customer' => [
                'name' => $order->customer_name,
                'contact' => $order->customer_contact,
                'email' => $order->customer_email,
            ],
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $order = $request->all();
        $order['user_id'] = Auth::user()->id;
        $order = Order::create($order);

        $order = Order::find($order->id);
        $package = Package::where('id', $order->package_id)->first('price');
        $order->items()->createMany([
            [
                'order_id' => $order->id,
                'product_id' => 1,
                'price' => $package->price,
                'qty' => 1
            ],
            [
                'order_id' => $order->id,
                'product_id' => 2,
                'price' => 0,
                'qty' => 1
            ],
        ]);

        return redirect()->route('orders.create', ['order' => $order->invoice]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return redirect()->route('orders.show', [
            'order' => $order->invoice,
            'packages' => Package::where('status', 1)->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    public function payment(Request $request, Order $order)
    {
        $order = Order::where('invoice', $order->invoice)->first();
        return view('dashboard.transactions.orders.payment', [
            'id' => $order->id,
            'invoice' => $order->invoice,
            'package' => Package::where('id', $order->package_id)->first('name'),
            'products' => Product::whereNotIn('id', Item::where('order_id', $order->id)->get('product_id'))->get(),
            'customer' => [
                'name' => $order->customer_name,
                'contact' => $order->customer_contact,
                'email' => $order->customer_email,
            ]
        ]);
    }

    public function paymentProcess(Request $request, Order $order)
    {
        // UPDATE ORDER
        $data = $request->all();
        $data['status'] = 1;
        if ($request->payment_methode === 'cash') {
            $data['amount'] = $request->amount;
        } else {
            $data['amount'] = $request->total;
        }

        $updateOrder = Order::findOrFail($order->id);
        $updateOrder->fill($data);
        $updateOrder->save();

        // UPDATE STOCK        
        return redirect()->route('orders.stock.update', ['order' => $updateOrder->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }

    public function Invoice(Order $order)
    {
        return view('dashboard.transactions.orders.invoice', [
            'order' => Order::where('invoice', $order->invoice)->first(),
            'package' => Package::where('id', $order->package_id)->first('name'),
            'items' => Item::where('order_id', $order->id)->with('product')->get(),
        ]);
    }

    public function receipt(Order $order)
    {
        if ($order->status === 0) {
            return redirect()->route('orders.payment', ['order' => $order->invoice]);
        }
        return view('dashboard.transactions.orders.receipt', [
            'order' => Order::where('invoice', $order->invoice)->first(),
            'package' => Package::where('id', $order->package_id)->first('name'),
            'items' => Item::where('order_id', $order->id)->with('product')->get(),
        ]);
    }
}
