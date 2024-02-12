<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function visitor()
    {
        $visitor = Item::sum('qty')->get();
    }

    public function sales()
    {
        $sales = Order::where('status', 1)->with('items');
    }

    public function product()
    {
    }

    public function usersInfo()
    {
    }
}
