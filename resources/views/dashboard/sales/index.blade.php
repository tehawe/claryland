@extends('dashboard.layouts.main')


@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="border-bottom border-dark">Sales</h1>
                @if ($sales->count() >= 1)
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Invoice</th>
                                <th>Items</th>
                                <th>Totals</th>
                                <th>Payment Method</th>
                                <th>Cashier</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sale->invoice }}</td>
                                    <td>{{ $sale->items_sum_qty }}</td>
                                    <td>{{ 'Rp ' . number_format($sale->total) }}</td>
                                    <td>{{ $sale->payment_method }}</td>
                                    <td>{{ $sale->user->name }}</td>
                                    <td><a href="{{ route('orders.show', ['order' => $sale->invoice]) }}">Check</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="bg-warning p-2 my-2 text-center w-50 rounded">
                        Data sales not found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
