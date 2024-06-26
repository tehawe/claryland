<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Http\Resources\OrderResource;
use App\Http\Resources\ProductNotInCollection;
use App\Models\Order;
use App\Models\Package;
use App\Models\Item;
use App\Models\Product;
use App\Models\Settlement;
use App\Models\Stock;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            'pendingOrders' => Order::where('status', 0)->withSum('items', 'qty')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create(Order $order)
    {
        $order = Order::where('invoice', $order->invoice)->first();
        $package = Package::where('id', $order->package_id)->firstOrFail('name');
        if ($order->status === 1) {
            return redirect()->route('orders.invoice', [
                'order' => $order->invoice,
                'package' => $package->name,
            ]);
        }
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
        $cekOrder = Order::where('invoice', $order['invoice'])->first();
        if ($cekOrder) {
            $order['invoice'] = $this->newInvoice();
        }
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

    public function orderCustomCreate(Order $order)
    {

        return view('dashboard.transactions.orders.custom', [
            'id' => $order->id,
            'invoice' => $order->invoice,
            'products' => Product::whereNotIn('id', [1, 2])->get(),
        ]);
    }

    public function orderCustomStore(Request $request)
    {
        $order = $request->all();
        $cekOrder = Order::where('invoice', $order['invoice'])->first();
        if ($cekOrder) {
            $order['invoice'] = $this->newInvoice();
        }
        $order['user_id'] = Auth::user()->id;
        $order = Order::create($order);

        $order = Order::find($order->id);
        return redirect()->route('orders.custom.create', ['order' => $order->invoice]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('dashboard.transactions.orders.show', [
            'order' => Order::where('invoice', $order->invoice)->first(),
            'package' => Package::where('id', $order->package_id)->first(),
            'items' => Item::where('order_id', $order->id)->with('product')->get(),
            'settlement' => Settlement::where('status', 1)->get()->last(),
            'tickets' => Ticket::where('order_id', $order->id)->get(),
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
        $stocks = Stock::where('description', $order->invoice)->get();
        foreach ($stocks as $stock) {
            $stock->delete();
        }

        $data = $request->all();
        $data['status'] = 0;
        $data['user_id'] = Auth::user()->id;
        $updateOrder = Order::findOrFail($order->id);
        $updateOrder->fill($data);
        $updateOrder->save();

        return redirect()->route('orders.payment', ['order' => $order->invoice]);
    }

    public function payment(Request $request, Order $order)
    {
        $order = Order::where('invoice', $order->invoice)->first();
        return view('dashboard.transactions.orders.payment', [
            'id' => $order->id,
            'invoice' => $order->invoice,
            'amount' => $order->amount,
            'payment_method' => $order->payment_method,
            'total' => $order->total,
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
        if ($request->payment_method === 'cash') {
            $data['amount'] = $request->amount;
        } else if ($request->payment_method === 'card') {
            $data['total'] = $request->total - ($request->total * 0.01);
            $data['amount'] = $request->total;
        } else {
            $data['total'] = $request->total - ($request->total * 0.007);
            $data['amount'] = $request->total;
        }
        $data['user_id'] = $data['user_id'] = Auth::user()->id;
        $updateOrder = Order::findOrFail($order->id);
        $updateOrder->fill($data);
        $updateOrder->save();

        // UPDATE STOCK        
        return redirect()->route('orders.stock.update', ['order' => $updateOrder->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancel(Order $order)
    {
        $data = Order::where('invoice', $order->invoice)->firstOrFail();
        $tickets = Ticket::where('order_id', $order->id)->get();
        foreach ($tickets as $ticket) {
            $ticket->delete();
        }
        $stocks = Stock::where('description', $order->invoice)->get();
        foreach ($stocks as $stock) {
            $stock->delete();
        }
        $items = Item::where('order_id', $order->id)->get();
        foreach ($items as $item) {
            $item->delete();
        }
        $data->delete();
        return redirect()->route('orders')->with('cancel', 'success');
    }


    public function invoice(Order $order)
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
