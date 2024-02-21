<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function ticketLast($constanta, $code)
    {
        $ticket_code = Ticket::where('ticket_code', '<>', null);
        $ticket_code = $ticket_code->where('ticket_code', $constanta, $code)->max('ticket_code');
        return $ticket_code;
    }

    public function index()
    {
        $counter = DB::table('items')->select('items.product_id', DB::raw('SUM(items.qty) qty'), DB::raw('SUM(items.qty * items.price) AS subtotal'), DB::raw('MIN(price) price'), DB::raw('(SELECT products.name FROM products  WHERE products.id = items.product_id) AS product_name'))->whereMonth('items.created_at', date_format(now(), 'm'))->groupBy('product_id')->get();

        $orders = Order::selectRaw('id, invoice, total, DAY(created_at) as created_date, created_at, payment_method, package_id')->whereMonth('created_at', now('m'))->withCount('items')->withSum('items', 'qty')->orderBy('created_at', 'ASC')->get()->groupBy('created_date');

        $countOrders = Order::where('status', 1)->get();

        $tiketBermain = $this->ticketLast('NOT LIKE', 'CLP%');
        $tiketPendamping = $this->ticketLast('NOT LIKE', 'CLP+%');
        $tiketPendampingTambahan = $this->ticketLast('LIKE', 'CLP+%');

        $products = Product::whereNotIn('id', [1, 2, 3])->orderBy('name', 'ASC')->with('stocks')->with('items')->get();

        return view('dashboard.index', compact('counter', 'orders', 'countOrders', 'tiketBermain', 'tiketPendamping', 'tiketPendampingTambahan', 'products'));
    }

    public function cashierDashboard()
    {
        $orders = Order::where('status', 1)->whereDate('created_at', now('d'))->get();

        $products = Product::whereNotIn('id', [1, 2, 3])->with('stocks')->orderBy('name', 'ASC')->get();

        $sales = DB::table('items')
            ->select('items.product_id', DB::raw('SUM(items.qty) qty'), DB::raw('SUM(items.qty * items.price) AS subtotal'), DB::raw('MIN(price) price'), DB::raw('(SELECT products.name FROM products  WHERE products.id = items.product_id) AS product_name'))
            ->whereDate('items.created_at', now('d'))
            ->groupBy('product_id')
            ->get();

        $tiketBermain = $this->ticketLast('NOT LIKE', 'CLP%');
        $tiketPendamping = $this->ticketLast('NOT LIKE', 'CLP+%');
        $tiketPendampingTambahan = $this->ticketLast('LIKE', 'CLP+%');

        return view('dashboard.cashier', compact('sales', 'products', 'tiketBermain', 'tiketPendamping', 'tiketPendampingTambahan', 'orders'));
    }
}
