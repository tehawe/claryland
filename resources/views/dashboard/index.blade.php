@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="dashboard">
        <div class="row">
            <div class="col-md">
                <h1>Dashboard</h1>
                <div class="row gap-2 mb-2" id="counter">
                    <div class="col py-3 border rounded bg-warning bg-opacity-25">
                        <div class="row">
                            <div class="col">
                                <h3><i class="bi-cart me-2"></i>Orders</h3>
                                <h2 class="bg-warning bg-opacity-50 bg-gradient text-center p-2 rounded">{{ number_format($countOrders->count(), 0, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">{{ number_format($countOrders->where('package_id', '<>', null)->count(), 0, ',', '.') }}<br />Tiket</div>
                            <div class="col">{{ number_format($countOrders->where('package_id', null)->count(), 0, ',', '.') }}<br />Non Ticket</div>
                        </div>
                    </div>

                    <div class="col py-3 border rounded bg-info bg-opacity-25">
                        <div class="row">
                            <div class="col digit">
                                <h4><i class="bi-people-fill me-2"></i>Visitors</h4>
                                <h2 class="bg-info bg-opacity-50 text-center p-2 rounded">{{ number_format($counter->whereIn('product_id', [1, 2, 3])->sum('qty'), 0, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">{{ number_format($counter->whereIn('product_id', [1])->sum('qty')) }}<br />Anak</div>
                            <div class="col">{{ number_format($counter->whereIn('product_id', [2, 3])->sum('qty')) }}<br />Pendamping</div>
                        </div>
                    </div>

                    <div class="col py-3 border rounded bg-success bg-opacity-25">
                        <div class="row">
                            <div class="col">
                                <h3><i class="bi-graph-up-arrow me-2"></i>Earns</h3>
                                <h2 class="bg-success bg-opacity-50 bg-gradient text-center p-2 rounded">{{ 'Rp ' . number_format($counter->sum('subtotal'), 0, ',', '.') }}</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">{{ 'Rp ' . number_format($counter->whereIn('product_id', [1, 2, 3])->sum('subtotal'), 0, ',', '.') }}<br />from tiket</div>
                            <div class="col">{{ 'Rp ' . number_format($counter->whereNotIn('product_id', [1, 2, 3])->sum('subtotal'), 0, ',', '.') }}<br />from other</div>
                        </div>
                    </div>

                    <div class="col py-3 border rounded bg-danger bg-opacity-25">
                        <div class="row">
                            <div class="col">
                                <h3><i class="bi-cash me-2"></i>Spends</h3>
                                <h2 class="bg-danger bg-opacity-50 bg-gradient text-center p-2 rounded">{{ 'Rp ' . number_format($spends->modal) }}</h2>
                            </div>
                        </div>
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gap-2 mb-1">
            <div class="col-lg-9 border rounded py-2" id="last7days">
                <div id="sales-chart" class="highcharts-light"></div>
            </div>
            <div class="col-lg border rounded p-2 me-2 my-1" id="lastScannedTicket">
                <h5>Last Ticket Scanned</h5>
                <div class="row gap-2 px-2 mb-2">
                    <div class="col text-center rounded py-2 bg-gradient" style="background: #ff86d1;">
                        <h6>Ticket Bermain</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketBermain }}</h5>
                    </div>
                    <div class="col text-center rounded py-2 bg-gradient" style="background: #6bbcff;">
                        <h6>Ticket Pendamping</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketPendamping }}</h5>
                    </div>
                    <div class="col text-center rounded py-2 bg-gradient" style="background: #ba7dff;">
                        <h6>Ticket Pendamping (Tambahan)</h6>
                        <h5 class="bg-white py-1 rounded">{{ $tiketPendampingTambahan }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gap-2">
            <div class="col-lg col-md border rounded py-2" id="stocks">
                <h5>Daily Stocks</h5>
                <table class="table table-sm table-hover table-responsive">
                    <thead>
                        <tr class="text-center">
                            <th>Product Name</th>
                            <th>last Stock</th>
                            <th>Stock In</th>
                            <th>Stock Out</th>
                            <th>Current Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td align="center">{{ number_format($product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_out')) }}</td>
                                <td align="center">{{ number_format($product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])->sum('stock_in')) }}</td>
                                <td align="center">{{ number_format($product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', now('d')])->sum('stock_out')) }}</td>
                                <td align="center">
                                    {{ number_format($product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_in') - $product->stocks->where('created_at', '<', date('Y-m-d') . ' 00:00:00')->sum('stock_out') + $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', date('Y-m-d') . ' 23:59:59'])->sum('stock_in') - $product->stocks->whereBetween('created_at', [date('Y-m-d') . ' 00:00:00', now('d')])->sum('stock_out')) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg col-md border rounded py-2" id="stocks">
                <h5>Daily Sales</h5>
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
                                <td>{{ $sale->product->name }}</td>
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

    <script src="../js/highchart.js"></script>
    <script src="../js/highchart-dashboard.js"></script>
    <script src="../js/dashboard-plugin.js"></script>
    <script src="../js/accessibility.js"></script>

    <script>
        Highcharts.chart('sales-chart', {
            chart: {
                type: 'spline',
                inverted: false,
            },
            title: {
                text: 'Daily income this month',
                align: 'left'
            },

            xAxis: {
                reversed: false,
                title: {
                    enabled: false,
                },
                labels: {
                    format: '{value}-{{ date('M') }}',
                },
                maxPadding: 0,
                showLastLabel: true
            },
            yAxis: {
                title: {
                    enabled: false,
                },
                labels: {
                    format: 'Rp {value} JT'
                },
                lineWidth: 2
            },
            legend: {
                enabled: false
            },
            tooltip: {
                headerFormat: '{series.name}<br/>',
                pointFormat: '{point.x} {{ date('M Y') }}<br/><b>Rp {point.y} JT</br>'
            },
            plotOptions: {
                spline: {
                    marker: {
                        enable: false
                    }
                }
            },
            series: [{
                name: 'Earns',
                data: [
                    @foreach ($orders as $order => $earn)
                        [{{ $order }}, {{ $earn->sum('total') / 1000000 }}],
                    @endforeach
                ]

            }],
        });
    </script>
@endsection
