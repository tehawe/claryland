<?php

namespace App\Http\Controllers;

use App\Http\Resources\TicketCollection;
use App\Http\Resources\TicketResource;
use App\Models\Ticket;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transactions.tickets.index', [
            'orders' => Order::where('status', 1)->withSum('items', 'qty')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Order $order)
    {
        $tickets = collect(Ticket::where('order_id', $order->id)->get())->groupBy('product_id');
        return view('dashboard.transactions.tickets.create', [
            'invoice' => $order->invoice,
            'tickets' => $tickets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Order $order)
    {
        $ticket = Ticket::where('order_id', $order->id)->get();
        if (!$ticket->count()) {
            // find Qty on Item
            $items = Item::where('order_id', $order->id)->whereIn('product_id', [1, 2, 3])->get();

            // create ticket
            foreach ($items as $item) {
                for ($t = 0; $t < $item->qty; $t++) {
                    Ticket::create([
                        'order_id' => $order->id,
                        'item_id' => $item->id,
                        'product_id' => $item->product_id,
                    ]);
                }
            }
        }

        return redirect()->route('orders.ticket.create', ['order' => $order->invoice]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $tickets = collect(Ticket::where('order_id', $order->id)->get())->groupBy('product_id');
        return view('dashboard.transactions.tickets.show', [
            'invoice' => $order->invoice,
            'tickets' => $tickets
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function getTicket(Order $order, Ticket $ticket): TicketResource
    {
        return new TicketResource($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order, Ticket $ticket)
    {
        $data = $request->all();
        $ticket->fill($data);
        $ticket->save();

        return response()->json(['status' => 'success'])->setStatusCode(201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        //
    }
}
