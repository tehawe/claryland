@extends('dashboard.layouts.main')


@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1 class="border-bottom border-dark">Sales</h1>
                @if ($sales->count() >= 1)
                    <div class="border rounded p-2 my-2">
                        <table class="table table-sm table-bordered data-table">
                            <thead class="table-info">
                                <tr align="center" valign="middle">
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Dates</th>
                                    <th rowspan="2">Order Count</th>
                                    <th colspan="3">Sales</th>
                                    <th rowspan="2">Total</th>
                                    <th rowspan="2"></th>
                                </tr>
                                <tr align="center" valign="middle">
                                    <th align="center">Cash</th>
                                    <th align="center">Card</th>
                                    <th align="center">QRIS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $saleDate => $items)
                                    <tr align="center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ date_format(new DATETIME($saleDate), 'd/m/Y') }}</td>
                                        <td align="right">{{ $items->count() }}</td>
                                        <td align="right">{{ number_format($items->where('created_date', $saleDate)->where('payment_method', 'cash')->sum('total')) }}</td>
                                        <td align="right">{{ number_format($items->where('created_date', $saleDate)->where('payment_method', 'card')->sum('amount')) }}</td>
                                        <td align="right">{{ number_format($items->where('created_date', $saleDate)->where('payment_method', 'qris')->sum('amount')) }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($items->where('created_date', $saleDate)->where('payment_method', 'cash')->sum('total') + $items->where('created_date', $saleDate)->where('payment_method', 'card')->sum('amount') + $items->where('created_date', $saleDate)->where('payment_method', 'qris')->sum('amount')) }}</td>
                                        <td><a href="{{ route('sales.show', ['date' => $saleDate]) }}" class="btn btn-info btn-sm"><i class="bi-box-arrow-in-right me-1"></i>Detail</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-warning p-2 my-2 text-center w-50 rounded">
                        Data sales not found.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        let table = new DataTable('.data-table');
    </script>
@endsection
