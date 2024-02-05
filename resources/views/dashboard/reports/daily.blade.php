@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h3>Daily Report at {{ date_format(new DATETIME($date), 'd-M-Y') }}</h3>
                <div class="row mb-1">
                    <div class="col-md border me-1">
                        <h5>Visitor</h5>
                        @foreach ($visitors as $visitor => $data)
                            {{ $visitor . ' = ' . $data->sum('qty') }}<br />
                        @endforeach
                    </div>
                    <div class="col-md border me-1">
                        <h5>Transactions</h5>
                    </div>
                </div>
                <div class="row border">
                    <div class="col-md me-1">
                        <h5>Sales</h5>
                        <table>
                            <thead>
                                <tr>
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
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->products->name }}</td>
                                        <td>{{ $sale->price }}</td>
                                        <td>{{ $sale->sum('qty') }}</td>
                                        <td>{{ $sale->sum('qty') * $sale->price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="4" align="right">Grand Total</th>
                                    <th>1</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
