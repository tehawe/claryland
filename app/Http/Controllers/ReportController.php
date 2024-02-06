<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Order::selectRaw('id, invoice, total, DATE(created_at) as created_date, created_at, payment_method, package_id')
            ->where('status', 1)
            ->whereMonth('created_at', now('m'))
            ->withCount('items')
            ->withSum('items', 'qty')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('created_date');

        return view('dashboard.reports.index', compact('reports'));
    }

    public function daily(string $date)
    {
        $reports = DB::table('items')
            ->select('items.product_id', DB::raw('SUM(items.qty) qty'), DB::raw('SUM(items.qty * items.price) AS subtotal'), DB::raw('MIN(price) price'), DB::raw('(SELECT products.name FROM products  WHERE products.id = items.product_id) AS product_name'))
            ->whereDate('items.created_at', $date)
            ->groupBy('product_id')
            ->get();

        return view('dashboard.reports.daily', [
            'reports' => $reports,
            'date' => $date
        ]);
    }

    public function productSales(string $date)
    {
    }

    public function dailyTransaction(string $date)
    {
        $reports = Order::whereDate('created_at', $date)
            ->withCount('items')
            ->withSum('items', 'qty')
            ->orderBy('invoice', 'ASC')
            ->get();

        return view('dashboard.reports.daily.show', [
            'date' => $date
        ]);
    }

    public function dailyStock(string $date)
    {
        $report = Item::whereDate('created_at', $date)
            ->where('status', 1)
            ->withSum('items', 'qty')
            ->get();

        return view('dashboard.reports.daily', [
            'date' => $date,
            'reports' => $report,
        ]);
    }
}
