    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Invoice #{{ $order->invoice }}</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        </head>

        <body>
            <div class="container-fluid">
                <div class="row">
                    <div class="col p-2 m-3" id="order-invoice">
                        <div class="row justify-content-between">
                            <div class="col-sm-5">
                                <img src="/img/claryland-text.png" id="logo" class="w-100" style="margin: -1rem auto 1rem -1rem;" />
                                <p>
                                    Jatinangor Town Square (JATOS)
                                    <br />Jl. Raya Jatinangor No.150, Cikeruh, Kec. Jatinangor, Kabupaten Sumedang, Jawa Barat 45363
                                </p>
                            </div>
                            <div class="col-sm-4 align-content-center">
                                <h2>Invoice</h2>
                                <h5>{{ '#' . $order->invoice }}</h5>
                                <img src="https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=invoice%3A+{{ $order->invoice }}%0Awebsite%3A+https%3A%2F%2Fclaryland.com%2Finvoice%2F{{ $order->invoice }}&amp;qzone=1&amp;margin=0&amp;size=125x125&amp;ecc=L" alt="{{ $order->invoice }}" id="qrcode" />
                            </div>
                        </div>
                        <hr />
                        <div class="" id="order-customer">
                            <h6>Invoice To:</h6>
                            <p>
                                {{ $order->customer_name }}<br />
                                {{ $order->customer_contact }}<br />
                                {{ $order->customer_email }}
                            </p>
                        </div>
                        <div class="" id="order-package">
                            <h5>{{ $package->name }}</h5>
                        </div>
                        <div id="order-item">
                            <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr align="center">
                                        <th>No</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td align="right">{{ $loop->iteration }}</td>
                                            <td>{{ $item->product->name }}</td>
                                            <td align="right">{{ 'Rp ' . number_format($item->price) }}</td>
                                            <td align="right">{{ $item->qty }}</td>
                                            <td align="right">{{ 'Rp ' . number_format($item->qty * $item->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-success">
                                    <tr align="right">
                                        <th colspan="4">Total</th>
                                        <th>{{ 'Rp ' . number_format($order->total) }}</th>
                                    </tr>
                                    <tr align="right">
                                        <th colspan="4">
                                            <span class="d-block">Payment with {{ str($order->payment_method)->upper() }}</span>
                                            <span class="d-block">{{ str($order->card_number)->mask('*', 4, -4) }}</span>
                                        </th>
                                        <th>{{ 'Rp ' . number_format($order->amount) }}</th>
                                    </tr>
                                    @if ($order->payment_method === 'cash')
                                        <tr align="right">
                                            <th colspan="4">Change</th>
                                            <th>{{ 'Rp ' . number_format($order->amount - $order->total) }}</th>
                                        </tr>
                                    @endif
                                </tfoot>
                            </table>
                        </div>
                        <div class="footer">
                            <h4>Thank You</h4>
                            <p>{{ $order->user->name }}<br />Cashier</p>
                        </div>
                    </div>
                </div>
            </div>
        </body>

    </html>
