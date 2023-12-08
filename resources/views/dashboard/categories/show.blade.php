@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="my-2">
                    <div>
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                    </div>
                </div>
                <div class="p-2 border rounded">
                    <table class="table table-hover table-sm" id="data-table">
                        <thead class="table-info">
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-end">Rp {{ number_format($product->price) }}</td>
                                    <td class="text-end">{{ $product->stocks_sum_stock_in - $product->stocks_sum_stock_out }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            let table = new DataTable('#data-table');
        });
    </script>
@endsection
