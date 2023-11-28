@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <h3>Products</h3>
                <hr />
                <a href="/dashboard/products/create" class="btn btn-primary btn-sm">
                    <i class="bi-bag-plus me-1"></i>Add Product
                </a>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show my-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="my-3 p-3 border rounded">
                    <table class="table table-sm table-hover" id="data-table">
                        <thead class="table-secondary">
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-end">Rp {{ number_format($product->price) }}</td>
                                    <td class="text-end">{{ $product->category->name }}</td>
                                    <td class="text-end">{{ $product->stocks_sum_stock_in - $product->stocks_sum_stock_out }}</td>
                                    <td>action btn</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
