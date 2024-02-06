@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h3>Daily Report at {{ date_format(new DATETIME($date), 'd-M-Y') }}</h3>
                <div class="row mb-1">
                    <div class="col-md border me-1 mb-1 p-2">
                        <h5>Visitor</h5>
                        <div class="row">
                            <div class="col-sm">Total {{ $reports->whereIn('product_id', [1, 2, 3])->sum('qty') }}</div>
                            <div class="col-sm">Potentials {{ $reports->whereIn('product_id', [1, 3])->sum('qty') }}</div>
                        </div>
                    </div>
                    <div class="col-md border me-1 mb-1 p-2">
                        <h5>Transactions</h5>
                        <div class="row">
                            <div class="col-sm">Ticket {{ 'Rp ' . number_format($reports->whereIn('product_id', [1, 2, 3])->sum('subtotal')) }}</div>
                            <div class="col-sm">Non Ticket {{ 'Rp ' . number_format($reports->whereNotIn('product_id', [1, 2, 3])->sum('subtotal')) }}</div>
                        </div>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md me-1 mb-1">
                        <h5>Sales Detail</h5>
                        <table class="table table-bordered">
                            <thead class="table-info">
                                <tr align="center">
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $report)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $report->product_name }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($report->price) }}</td>
                                        <td align="center">{{ $report->qty }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($report->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-info">
                                <tr align="right">
                                    <th colspan="4">Grand Total</th>
                                    <th>{{ 'Rp ' . number_format($reports->sum('subtotal')) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
