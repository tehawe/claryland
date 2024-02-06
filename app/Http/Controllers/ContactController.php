<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ContactController extends Controller
{
    public function index()
    {
        $contacts = DB::table('orders')
            ->distinct()
            ->select(DB::raw('(CUSTOMER_CONTACT) AS contact'), 'customer_name AS name', 'customer_email as email')
            ->whereNotNull('customer_contact')
            ->orderByRaw('`name` ASC')
            ->get();

        return view('dashboard.contacts.index', compact('contacts'));
    }
}
