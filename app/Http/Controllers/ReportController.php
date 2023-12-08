<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Items;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        return view('dashboard.reports.index', [
            'order' => Order::all(),
        ]);
    }
}
