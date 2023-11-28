@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <h3>{{ $category->name }}</h3>
            <p>{{ $category->description }}</p>
            <div class="col-md-8">
                <table class="table table-hover" id="data-table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td class="text-end">Rp {{ number_format($product->price) }}</td>
                                <td class="text-end">{{ $product->stocks_sum_stock_in - $product->stocks_sum_stock_out }}</td>
                                <td>action button</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
