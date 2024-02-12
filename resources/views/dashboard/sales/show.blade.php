@extends('dashboard.layouts.main')

@section('container')
    <style>
        .data-table thead tr th {
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h2 class="pb-3 mb-3 border-bottom">Sales at {{ date_format(new DATETIME($date), 'd-M-Y') }}</h2>
                <div class="border rounded p-2 my-2">
                    <table class="table table-sm table-bordered data-table">
                        <thead class="table-info">
                            <tr valign="middle">
                                <th rowspan="2">No</th>
                                <th rowspan="2">Invoice</th>
                                <th colspan="2">Customer</th>
                                <th colspan="2">Product/Items</th>
                                <th rowspan="2">Order Type</th>
                                <th rowspan="2">Totals</th>
                                <th rowspan="2">Cashier</th>
                                <th rowspan="2"></th>
                            </tr>
                            <tr align="center">
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Count</th>
                                <th>Qty</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $sale)
                                <tr>
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td>{{ $sale->invoice }}</td>
                                    <td>{{ $sale->customer_name }}</td>
                                    <td>{{ $sale->customer_contact }}</td>
                                    <td align="center">{{ $sale->items_count }}</td>
                                    <td align="center">{{ $sale->items_sum_qty }}</td>
                                    <td>
                                        @if (!$sale->package_id)
                                            Custome
                                        @else
                                            Tiket
                                        @endif
                                    </td>
                                    <td align="right">{{ 'Rp ' . number_format($sale->total) }}</td>
                                    <td>{{ $sale->user->name }}</td>
                                    <td><a class="btn btn-info btn-sm" href="{{ route('orders.show', ['order' => $sale->invoice]) }}"><i class="bi-box-arrow-in-up-right me-1"></i>show</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        let table = new DataTable('.data-table');
    </script>
@endsection
