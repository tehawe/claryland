<?php

namespace App\Http\Controllers;

use App\Models\Settlement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SettlementController extends Controller
{
    public function getNewCode()
    {
        $settlement = Settlement::whereDate('created_at', DATE('Y-m-d'))->get('code')->last();
        if (!$settlement) {
            $sequential = 1;
        } else {
            $sequential = $sequential = substr($settlement->code, -3) + 1;
        }
        $newCode = 'CLS' . date('ymd') . Str::padLeft($sequential, 3, 0);
        return $newCode;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settlements = Settlement::whereDate('created_at', DATE('Y-m-d'));
        $newCode = $this->getNewCode();
        return view('dashboard.settlements.index', compact(['settlements', 'newCode']));
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
        $user = Auth::user();
        $data = $request->all();


        $data['code'] = $this->getNewCode();
        $data['sales_id'] = $user->id;
        Settlement::create($data);

        return response()->json([
            'action' => 'store',
            'status' => 'success'
        ])->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Settlement $settlement)
    {
        $data = Settlement::where('code', $settlement->code)->first();
        return view('dashboard.settlements.show', compact('data'));
    }

    public function current()
    {
        $settlements = Settlement::orderBy('created_at', 'DESC')->get();
        return view('dashboard.settlements.current', compact('settlements'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Settlement $settlement)
    {
        $data = Settlement::where('code', $settlement->code);
        return response()->json(['settlement' => $data])->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Settlement $settlement)
    {
        $data = $request->all();
        $update = Settlement::where('code', $settlement->code)->firstOrFail();
        if (isset($request['reason'])) {
            $update->reason = $request['reason'];
        }
        $update->status = $request['status'];
        $update->checker_id = Auth::user()->id;
        $update->save();

        return redirect()->route('settlements.show', ['settlement' => $settlement->code])->with('success', 'Settlement has been updated');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Settlement $settlement)
    {
        //
    }
}
