<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = Order::where('customer_contact', 'IS NOT', null)->get()->groupBy('customer_contact');

        return view('dashboard.contacts.index', compact('contacts'));
    }
}
