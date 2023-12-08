@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>{{ $title }}</h3>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-5">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Price</td>
                                    <td>Rp {{ number_format($product->price) }}</td>
                                </tr>
                                <tr>
                                    <td>Category</td>
                                    <td>{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <td>Stock In</td>
                                    <td>{{ $product->stocks_sum_stock_in }}</td>
                                </tr>
                                <tr>
                                    <td>Stock Out</td>
                                    <td>{{ $product->stocks_sum_stock_out }}</td>
                                </tr>
                                <tr>
                                    <td>Current Stock</td>
                                    <td>{{ $product->stocks_sum_stock_in - $product->stocks_sum_stock_out }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h5>Manage Stock</h5>
                        <button type="button" id="btn-stock-in" data-id="{{ $product->id }}" class="btn btn-primary btn-sm"><i class="bi-plus-square me-1"></i>Stock In</button>
                        <button type="button" id="btn-stock-out" data-id="{{ $product->id }}" class="btn btn-danger btn-sm"><i class="bi-dash-square me-1"></i>Stock Out</button>
                    </div>
                </div>
                <div id="data-stock" class="my-3 p-2 border rounded"></div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-stock" tabindex="-1" aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modal-title"></h1>
                    <button type="button" class="btn-close" id="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                }
            });

            $.get('/dashboard/products/' + {{ $product->id }} + '/stocks/data', {}, function(data, status) {
                $("#data-stock").html(data);
            });

            $('#btn-stock-in').on('click', function() {
                $.get('/dashboard/products/' + {{ $product->id }} + '/stocks/in', {}, function(data, status) {
                    $('#modal-title').html('Stock In');
                    $('#modal-body').html(data);
                    $('#modal-stock').modal('show');
                });
            });

            $('#btn-stock-out').on('click', function() {
                $.get('/dashboard/products/' + {{ $product->id }} + '/stocks/out', {}, function(data, status) {
                    $('#modal-title').html('Stock Out');
                    $('#modal-body').html(data);
                    $('#modal-stock').modal('show');
                });
            });

        });

        function edit(stockId) {
            $.get('/dashboard/products/' + {{ $product->id }} + '/stocks/' + stockId + '/edit', {}, function(data, status) {
                $('#modal-title').html('Edit Stock');
                $('#modal-body').html(data);
                $('#modal-stock').modal('show');
            });
        }

        function remove(stockId) {
            $.get('/dashboard/products/' + {{ $product->id }} + '/stocks/' + stockId + '/remove', {}, function(data, status) {
                $('#modal-title').html('Remove Stock Confirmation');
                $('#modal-body').html(data);
                $('#modal-stock').modal('show');
            });
        }

        function closeModal() {
            $('#btn-close').click();
        }
    </script>
@endsection
