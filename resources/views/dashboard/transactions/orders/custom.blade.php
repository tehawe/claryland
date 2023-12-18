@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="Orders">
        <div class="row">
            <div class="col-md-8">
                <h2 class="border-bottom p-3">Custom Order (#{{ $invoice }})</h2>
                <form id="form-add-item">
                    @csrf
                    <div class="input-group">
                        <select class="form-select" id="product_id" name="product_id" required>
                            <option value="">--Select Product--</option>
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm" id="btn-add-item"><i class="bi-plus-square me-1"></i>Add Item</button>
                    </div>
                </form>

                <div class="my-2 p-2 border rounded" id="list-items">
                    <table class="table table-hover">
                        <thead class="table-info">
                            <tr align="center">
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="data-item">
                        </tbody>
                        <tfoot class="table-info">
                            <tr align="right">
                                <th></th>
                                <th></th>
                                <th>Total</th>
                                <th><span class="total-item"></span></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('orders.payment', ['order' => $invoice]) }}" id="btn-checkout" class="btn btn-outline-success btn-sm"><i class="bi-bag-check me-1"></i>Check Out</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Load Page
        $(document).ready(function() {
            getItemOrder({{ $id }});
            getListItem({{ $id }});
        });

        function currencyFormat(num) {
            return 'Rp ' + num.toLocaleString('id-ID', 'decimal');
        }


        // Get list Item
        const dataItems = document.querySelector('.data-item');
        const totalItem = document.querySelector('.total-item');

        function getItemOrder(id) {
            fetch('/orders/' + id + '/item')
                .then(response => response.json())
                .then(response => {
                    // Get List Items
                    const items = response.data;
                    let container = '';
                    items.forEach(item => container += dataItem(item));
                    dataItems.innerHTML = container;
                    // Get Total Price
                    let total = 0;
                    for (let i in items) {
                        total += items[i].price * items[i].qty;
                    }
                    totalItem.innerHTML = currencyFormat(total);
                })
                .catch(error => console.log(error));
        }

        // Display Item
        function dataItem(item) {
            let display = '';
            if (item.qty > 1) {
                display = '';
            } else {
                display = 'd-none';
            }

            return `<tr>
                <td>` + item.product_name + `</td>
                <td align="right">` + currencyFormat(item.price) + `</td>
                <td align="right">                    
                        <button class="btn btn-warning btn-sm btn-min ` + display + `" data-id="` + item.id + `"><i class="bi-dash-square"></i></button>
                        <input type="number" data-id="` + item.id + `" class="item-qty text-center" value="` + item.qty + `" required min="1" style="max-width:60px;">
                        <button class="btn btn-warning btn-sm btn-plus" data-id="` + item.id + `"><i class="bi-plus-square"></i></button>
                </td>
                <td align="right">` + currencyFormat(item.price * item.qty) + ` </td>
                <td>
                    <button class = "btn btn-danger btn-sm btn-delete" data-id="` + item.id + `"><i class="bi-trash"></i></button></td>
            </tr>`;
        }

        // List Select Product
        function getListItem(id) {
            fetch('http://127.0.0.1:8000/orders/' + id + '/product')
                .then(response => response.json())
                .then(response => {
                    // Get List Items
                    const products = response.data;
                    let container = '';
                    products.forEach(product => container += listProduct(product));
                    const listProducts = document.querySelector('#product_id');
                    listProducts.innerHTML = `<option value="">--Select Product--</option>` + container;
                })
                .catch(error => console.log(error));
        }

        function listProduct(product) {
            return `<option value="` + product.id + `">` + product.name + `</option>`;
        }

        // Add Item / Product
        $('#form-add-item').submit(function(e) {
            e.preventDefault();
            let params = $(this).serialize();
            $.ajax({
                url: '/orders/' + {{ $id }} + '/item/store?' + params,
                method: 'GET',
                success: function(response) {
                    getItemOrder({{ $id }});
                    getListItem({{ $id }});
                }
            });
        });

        let orderId = {{ $id }};

        $('.data-item').on('change', '.item-qty', function() {
            let itemId = $(this).data('id');
            let newQty = $(this).val();
            if (newQty < 1) {
                alert('Qty can not less then 1');
                getItemOrder({{ $id }});
            } else {
                $.ajax({
                    url: '/orders/' + orderId + '/item/' + itemId + '/update',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        qty: newQty
                    },
                    success: function(response) {
                        getItemOrder({{ $id }});
                        getListItem({{ $id }});
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            }
        });

        // Plus Qty Item
        $('.data-item').on('click', '.btn-plus', function() {
            let btnPlus = $(this).data('id');
            $.ajax({
                url: '/orders/' + orderId + '/item/' + btnPlus + '/plus',
                method: 'GET',
                success: function(response) {
                    getItemOrder({{ $id }});
                    getListItem({{ $id }});
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        // Plus Qty Item
        $('.data-item').on('click', '.btn-min', function() {
            let btnMin = $(this).data('id');
            $.ajax({
                url: '/orders/' + orderId + '/item/' + btnMin + '/min',
                method: 'GET',
                success: function(response) {
                    getItemOrder({{ $id }});
                    getListItem({{ $id }});
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $('.data-item').on('click', '.btn-delete', function() {
            let itemId = $(this).data('id');
            $.ajax({
                url: '/orders/' + orderId + '/item/' + itemId + '/delete',
                method: 'GET',
                success: function(response) {
                    getItemOrder({{ $id }});
                    getListItem({{ $id }});
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>
@endsection
