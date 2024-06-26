@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h3>Monthly Report at {{ date_format(new DATETIME($month), 'F Y') }}</h3>
                <div class="row mb-2">
                    <div class="col-md border me-1 mb-1 p-2">
                        <h5>Visitor</h5>
                        <div class="row">
                            <div class="col-sm">Total {{ $reports->whereIn('product_id', [1, 2, 3])->sum('qty') }}</div>
                            <div class="col-sm">Potentials {{ $reports->whereIn('product_id', [1, 3])->sum('qty') }}</div>
                        </div>
                    </div>
                    <div class="col-md border me-1 mb-1 p-2">
                        <h5>Sales</h5>
                        <div class="row">
                            <div class="col-sm"><i class="bi-cash-coin me-1"></i> Cash<br />{{ 'Rp ' . number_format($salesCash->total) }}</div>
                            <div class="col-sm"><i class="bi-credit-card me-1"></i> Card<br /> {{ 'Rp ' . number_format($salesCard->totalAmount) }}</div>
                            <div class="col-sm"><i class="bi-qr-code me-1"></i> QRIS<br /> {{ 'Rp ' . number_format($salesQris->totalAmount) }}</div>
                        </div>
                    </div>
                </div>
                <div class="row mb-1 border py-2">
                    <div class="col-md me-1 mb-1">
                        <h5>Sales Detail</h5>
                        <table class="table table-sm table-bordered">
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
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>
                                            {{ $report->product_name }}
                                            @if ($report->price == 25000 && $report->product_id == 1)
                                                (Soft Opening)
                                            @elseif($report->price == 60000 && $report->product_id == 1)
                                                (Weekends or holidays)
                                            @elseif($report->price == 50000 && $report->product_id == 1)
                                                (Regular or Weekdays)
                                            @endif
                                        </td>
                                        <td align="right">{{ 'Rp ' . number_format($report->price) }}</td>
                                        <td align="center">{{ number_format($report->qty) }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($report->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-info">
                                <tr align="right">
                                    <th colspan="4">Grand Total</th>
                                    <th>{{ 'Rp ' . number_format($reports->sum('subtotal')) }}</th>
                                </tr>
                                @if ($salesCard->total > 0)
                                    <tr align="right">
                                        <th colspan="4">MDR Card (1%)</th>
                                        <th>{{ '- Rp ' . number_format($salesCard->total) }}</th>
                                    </tr>
                                @endif
                                @if ($salesQris->total > 0)
                                    <tr align="right">
                                        <th colspan="4">MDR QRIS (0,7%)</th>
                                        <th>{{ '- Rp ' . number_format($salesQris->total) }}</th>
                                    </tr>
                                @endif
                                <tr align="right">
                                    <th colspan="4">Sales Revenue</th>
                                    <th>{{ 'Rp ' . number_format($reports->sum('subtotal') - $salesCard->total - $salesQris->total) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row mb-1 border py-2">
                    <div class="col-md me-1 mb-1">
                        <h5>Stocks Detail</h5>
                        <table class="table table-sm table-hover table-bordered">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Product Name</th>
                                    <th>Last Stock</th>
                                    <th>Stock In</th>
                                    <th>Modal</th>
                                    <th>Stock Out</th>
                                    <th>Current Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product => $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product }}</td>
                                        <td align="center">{{ number_format($stock->where('created_at', '<', $firstDay . ' 00:00:00')->sum('stock_in') - $stock->where('created_at', '<', $firstDay . ' 00:00:00')->sum('stock_out')) }}</td>

                                        <td align="center">{{ number_format($stock->whereBetween('created_at', [$firstDay . ' 00:00:00', $lastDay . ' 23:59:59'])->sum('stock_in')) }}</td>

                                        <td align="right">
                                            {{ 'Rp ' .number_format($stock->where('stock_in', '<>', null)->whereBetween('created_at', [$firstDay . ' 00:00:00', $lastDay . ' 23:59:59'])->sum('modal')) }}
                                        </td>

                                        <td align="center">{{ number_format($stock->whereBetween('created_at', [$firstDay . ' 00:00:00', $lastDay . ' 23:59:59'])->sum('stock_out')) }}</td>

                                        <td align="center">
                                            {{ number_format($stock->where('created_at', '<', $firstDay . ' 00:00:00')->sum('stock_in') - $stock->where('created_at', '<', $firstDay . ' 00:00:00')->sum('stock_out') + $stock->whereBetween('created_at', [$firstDay . ' 00:00:00', $lastDay . ' 23:59:59'])->sum('stock_in') - $stock->whereBetween('created_at', [$firstDay . ' 00:00:00', $lastDay . ' 23:59:59'])->sum('stock_out')) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
