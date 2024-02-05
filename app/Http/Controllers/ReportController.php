<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
        $visitors = Order::whereIn('product_id', [1, 2, 3])
            ->whereDate('created_at', $date)
            ->get()
            ->groupBy('product_id');

        $transactions = Item::whereDate('created_at', $date)->get();

        $sales = [];

        return view('dashboard.reports.daily', [
            'visitors' => $visitors,
            'transactions' => $transactions,
            'sales' => $sales,
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
