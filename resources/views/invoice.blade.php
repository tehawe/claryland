@extends('layouts.main')

@section('container')
    <div class="container-fluid" id="invoice">
        <div class="row">
            <div class="col-lg-4 border border-secondary rounded py-2 mx-auto">
                <h4 class="mb-3">Claryland Playground</h4>
                <h5>{{ 'Invoice ' . $order->invoice }}</h5>
                <span class="fs-6">{{ date_format($order->created_at, 'd/m/Y h:i') }}</span>
                <div class="row">
                    <div class="col my-2 fs-5">
                        {{ $order->customer_name . ' (' . $order->customer_contact . ')' }}
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table class="table table-sm table-hover">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($item->price) }}</td>
                                        <td align="center">{{ number_format($item->qty) }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($item->qty * $item->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-primary">
                                <tr class="text-end">
                                    <th colspan="3">Grand Total</th>
                                    <th>{{ 'Rp ' . number_format($order->total) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-2">
                        Terima Kasih<br /><br />
                        {{ $order->cashier->name }}<br />
                        Cashier
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
