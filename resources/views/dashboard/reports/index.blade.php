@extends('dashboard.layouts.main')


@section('container')
    <style>
        .data-table thead tr th {
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row py-2">
            <div class="col">
                <h1 class="border-bottom border-secondary pb-3 mb-3">Report</h1>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('reports.monthly', ['month' => date('Y-m')]) }}" class="btn btn-sm btn-primary me-1">This Month</a>
                    <button class="btn btn-sm btn-primary me-1">Last 3 Month</button>
                    <button class="btn btn-sm btn-primary">Filter</button>
                </div>
                <div class="row border rounded p-2 my-2">
                    <div class="col">
                        <table class="table table-sm table-hover table-bordered data-table">
                            <thead class="table-success">
                                <tr align="center" valign="middle">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Date</th>
                                    <th colspan="2">Order Type</th>
                                    <th rowspan="2">All Order</th>
                                    <th colspan="2">Produc/Items</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr align="center" valign="middle">
                                    <th>Ticket</th>
                                    <th>Custom</th>
                                    <th>Count</th>
                                    <th>Qty</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reports as $reportDate => $items)
                                    <tr align="center" valign="middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date_format(new DATETIME($reportDate), 'd/m/Y') }}</td>
                                        <td align="center">{{ $items->where('package_id', '<>', null)->count() }}</td>
                                        <td>{{ $items->where('package_id', null)->count() }}</td>
                                        <td>{{ $items->count() }}</td>
                                        <td>{{ $items->sum('items_count') }}</td>
                                        <td>{{ $items->sum('items_sum_qty') }}</td>

                                        <td align="right">{{ 'Rp ' . number_format($items->where('created_date', $reportDate)->sum('total')) }}</td>
                                        <td><a href="{{ route('reports.daily', ['date' => $reportDate]) }}" class="btn btn-sm btn-primary">Check</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let table = new DataTable('.data-table');
    </script>
@endsection
