@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h3>Daily Report at {{ date_format(new DATETIME($date), 'd-M-Y') }}</h3>
                <table class="table table-sm table-hover data-table">
                    <thead class="table-success">
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Payment Method</th>
                            <th>Cashier</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $report->invoice }}</td>
                                <td>{{ $report->items_sum_qty }}</td>
                                <td align="right">{{ 'Rp ' . number_format($report->total) }}</td>
                                <td>{{ Str::upper($report->payment_method) }}</td>
                                <td>{{ $report->user->name }}</td>
                                <td><a href="" class="btn btn-info btn-sm"><i class="bi-arrow-left-in me-1"></i>Check</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
