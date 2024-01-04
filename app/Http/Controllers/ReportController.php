<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Items;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Order::selectRaw('id, invoice, total, DATE(created_at) as created_date, created_at, payment_method, package_id')
            ->where('status', 1)
            ->withCount('items')
            ->withSum('items', 'qty')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('created_date');

        return view('dashboard.reports.index', compact('reports'));
    }

    public function dailyTransaction(string $date)
    {
        $report = Order::whereDate('created_at', $date)
            ->where('status', 1)
            ->withSum('items', 'qty')
            ->get();

        return view('dashboard.reports.daily', [
            'date' => $date,
            'reports' => $report,
        ]);
    }

    public function dailyStock(string $date)
    {
        $report = Stock::whereDate('created_at', $date)
            ->where('status', 1)
            ->withSum('items', 'qty')
            ->get();

        return view('dashboard.reports.daily', [
            'date' => $date,
            'reports' => $report,
        ]);
    }
}
