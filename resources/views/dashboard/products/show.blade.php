@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h3>{{ $title }}</h3>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>{{ $product->name }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>Rp {{ $product->price }}</td>
                        </tr>
                        <tr>
                            <td>Category</td>
                            <td>{{ $product->category->name }}</td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            <td>Stock</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
