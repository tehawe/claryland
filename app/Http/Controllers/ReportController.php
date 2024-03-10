<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use App\Models\Package;
use App\Models\Product;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Order::selectRaw('id, invoice, total, DATE(created_at) as created_date, created_at, payment_method, package_id')
            ->withCount('items')
            ->withSum('items', 'qty')
            ->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('created_date')->take(100);

        $lastMonth = date_format(Carbon::now()->subMonths(1), 'Y-m');


        return view('dashboard.reports.index', compact('reports', 'lastMonth'));
    }

    public function daily(string $date)
    {
        $reports = DB::table('items')
            ->select('items.product_id', 'items.price', DB::raw('SUM(items.qty) qty'), DB::raw('SUM(items.qty * items.price) AS subtotal'), DB::raw('(SELECT products.name FROM products WHERE products.id = items.product_id) AS product_name'))
            ->whereDate('items.created_at', $date)->orderBy('product_id', 'ASC')
            ->groupBy('product_id', 'price')
            ->get();

        $products = Product::with('stocks')->orderBy('id', 'ASC')->get();

        return view('dashboard.reports.daily', [
            'reports' => $reports,
            'date' => $date,
            'products' => $products
        ]);
    }


    public function monthly(string $month)
    {
        $reports = DB::table('items')
            ->select('items.product_id', 'items.price', DB::raw('SUM(items.qty) qty'), DB::raw('SUM(items.qty * items.price) AS subtotal'), DB::raw('(SELECT products.name FROM products WHERE products.id = items.product_id) AS product_name'))
            ->whereMonth('items.created_at', date_format(date_create($month), 'm'))->orderBy('product_id')
            ->groupBy('product_id', 'price')
            ->get();

        $products = DB::table('stocks')
            ->select(
                'stocks.created_at',
                'stocks.stock_in',
                'stocks.stock_out',
                DB::raw("SUBSTRING_INDEX(stocks.description,'Rp',-1) AS modal"),
                DB::raw('(SELECT products.name FROM products WHERE products.id = stocks.product_id) AS product_name')
            )
            ->orderBy('product_name', 'ASC')->get()->groupBy('product_name');

        $last_day = $month . '-' . Carbon::parse($month . '-01')->lastOfMonth()->day;

        return view('dashboard.reports.monthly', [
            'reports' => $reports,
            'products' => $products,
            'month' => $month,
            'firstDay' => $month . '-01',
            'lastDay' => $last_day,
        ]);
    }


    public function dailyTransaction(string $date)
    {
        $reports = Order::whereDate('created_at', $date)
            ->where('status', 1)
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
