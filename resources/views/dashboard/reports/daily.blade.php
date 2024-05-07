@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
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
                        <h5>Sales</h5>
                        <div class="row">
                            <div class="col-sm"><i class="bi-cash-coin me-1"></i> Cash<br />{{ 'Rp ' . number_format($salesCash->total) }}</div>
                            <div class="col-sm"><i class="bi-credit-card me-1"></i> Card<br /> {{ 'Rp ' . number_format($salesCard->totalAmount) }}</div>
                            <div class="col-sm"><i class="bi-qr-code me-1"></i> QRIS<br /> {{ 'Rp ' . number_format($salesQris->totalAmount) }}</div>
                        </div>
                    </div>
                </div>
                <div class="row border mb-2 rounded">
                    <div class="col py-2">
                        <h5>Sales Detail</h5>
                        <table class="table table-sm table-bordered table-hover">
                            <thead class="table-info">
                                <tr class="text-center">
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
                                <tr align="right">
                                    <th colspan="4">MDR Card (1%)</th>
                                    <th>{{ '- Rp ' . number_format($salesCard->total) }}</th>
                                </tr>
                                <tr align="right">
                                    <th colspan="4">MDR QRIS (0,7%)</th>
                                    <th>{{ '- Rp ' . number_format($salesQris->total) }}</th>
                                </tr>
                                <tr align="right">
                                    <th colspan="4">Sales Revenue</th>
                                    <th>{{ 'Rp ' . number_format($reports->sum('subtotal') - $salesCard->total - $salesQris->total) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row border mb-2 rounded">
                    <div class="col py-2">
                        <h5>Stocks Detail</h5>
                        <table class="table table-sm table-hover table-bordered">
                            <thead class="table-primary text-center">
                                <tr valign="middle">
                                    <th>No</td>
                                    <th>Product Name</th>
                                    <th>Last Stock</th>
                                    <th>Stock In</th>
                                    <th>Stock Out</th>
                                    <th>Current Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td align="center">{{ number_format($product->stocks->where('created_at', '<', $date . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', $date . ' 00:00:00')->sum('stock_out')) }}</td>
                                        <td align="center">{{ number_format($product->stocks->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->sum('stock_in')) }}</td>
                                        <td align="center">{{ number_format($product->stocks->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->sum('stock_out')) }}</td>
                                        <td align="center">
                                            {{ number_format($product->stocks->where('created_at', '<', $date . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', $date . ' 00:00:00')->sum('stock_out') + $product->stocks->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->sum('stock_in') - $product->stocks->whereBetween('created_at', [$date . ' 00:00:00', $date . ' 23:59:59'])->sum('stock_out')) }}
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
