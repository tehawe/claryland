<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth::user();

        $sales = Order::selectRaw('id, invoice, total, DATE(created_at) as created_date, created_at, payment_method')
            ->where('status', 1);
        if (!$user->access_type) {
            $sales = $sales->where('user_id', $user->id);
        }
        $sales = $sales->orderBy('created_at', 'DESC')
            ->get()
            ->groupBy('created_date');


        return view('dashboard.sales.index', [
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $date)
    {
        $user = Auth::user();
        $sales = Order::whereDate('created_at', $date)->withCount('items')->withSum('items', 'qty')->orderBy('invoice', 'ASC');
        if (!$user->access_type) {
            $sales = $sales->where('user_id', $user->id);
        }
        $sales = $sales->get();

        return view('dashboard.sales.show', [
            'date' => $date,
            'sales' => $sales
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
