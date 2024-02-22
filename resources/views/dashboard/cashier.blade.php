@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="dashboard">
        <h2 class="border-bottom">Dashboard</h2>
        <div class="row gap-2 mb-3">
            <div class="col rounded bg-warning bg-gradient bg-opacity-25 pt-2">
                <h3><i class="bi-cart me-2"></i>Orders</h3>
                <h3 class="bg-warning bg-opacity-50 text-center p-2 rounded">{{ $orders->count() }}</h3>
            </div>
            <div class="col rounded bg-info bg-gradient bg-opacity-25 pt-2">
                <h3><i class="bi-people me-2"></i>Visitor</h3>
                <h3 class="bg-info bg-opacity-50 text-center p-2 rounded">{{ $sales->whereIn('product_id', [1, 2, 3])->sum('qty') }}</h3>
            </div>
            <div class="col-lg rounded bg-success bg-gradient bg-opacity-25 pt-2">
                <h3><i class="bi-cash me-2"></i>Sales</h3>
                <h3 class="bg-success bg-opacity-50 text-center p-2 rounded">{{ 'Rp ' . number_format($sales->sum('subtotal')) }}</h3>
            </div>
        </div>
        <div class="row gap-2 mb-3">

            <div class="col-lg border rounded py-2">
                <h5>Product</h5>
                <table class="table table-sm table-hover table-bordered">
                    <thead class="table-primary text-center">
                        <tr valign="middle">
                            <th>No</th>
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
                                <td align="center">{{ $product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_out') }}</td>
                                <td align="center">{{ $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])->sum('stock_in') }}</td>
                                <td align="center">{{ $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', now('d')])->sum('stock_out') }}</td>
                                <td align="center">
                                    {{ $product->stocks->where('created_at', '<', now('d') . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_out') + $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])->sum('stock_in') - $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', now('d')])->sum('stock_out') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-lg-8 border rounded py-2">
                <h5>Last Scanned</h5>
                <div class="row gap-2 px-2 mb-2">
                    <div class="col-md text-center rounded py-2 bg-gradient" style="background: #ff86d1;">
                        <h6>Ticket Bermain</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketBermain }}</h5>
                    </div>
                    <div class="col-md text-center rounded py-2 bg-gradient" style="background: #6bbcff;">
                        <h6>Ticket Pendamping</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketPendamping }}</h5>
                    </div>
                    <div class="col-md text-center rounded py-2 bg-gradient" style="background: #ba7dff;">
                        <h6>Ticket Pendamping (Tambahan)</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketPendampingTambahan }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
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
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td align="center">{{ $loop->iteration }}</td>
                                        <td>{{ $sale->product_name }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($sale->price) }}</td>
                                        <td align="center">{{ $sale->qty }}</td>
                                        <td align="right">{{ 'Rp ' . number_format($sale->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-info">
                                <tr align="right">
                                    <th colspan="4">Grand Total</th>
                                    <th>{{ 'Rp ' . number_format($sales->sum('subtotal')) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
