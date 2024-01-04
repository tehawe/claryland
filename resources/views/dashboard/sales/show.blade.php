@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h2 class="pb-3 mb-3 border-bottom">Sales at {{ $date }}</h2>
                <div class="rounded">
                    <table class="table table-sm table-bordered data-table">
                        <thead class="table-info">
                            <tr align="center" valign="middle">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Invoice</th>
                                <th colspan="2">Product/Items</th>
                                <th rowspan="2">Totals</th>
                                <th rowspan="2">Payment Method</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr align="center">
                                <th>Count</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sale->invoice }}</td>
                                    <td>{{ $sale->items_count }}</td>
                                    <td>{{ $sale->items_sum_qty }}</td>
                                    <td align="right">{{ 'Rp ' . number_format($sale->total) }}</td>
                                    <td>{{ Str::upper($sale->payment_method) }}</td>
                                    <td><a class="btn btn-info btn-sm" href="{{ route('orders.show', ['order' => $sale->invoice]) }}"><i class="bi-box-arrow-in-up-right me-1"></i>show</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
