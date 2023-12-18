@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid no-print">
        <div class="row">
        </div>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between">
                    <h2>Invoice</h2>
                    <div>
                        <a href="{{ route('orders.ticket.store', ['order' => $order->invoice]) }}" class="btn btn-outline-success btn-sm me-1"><i class="bi-ticket-detailed me-1"></i>Create Ticket</a>
                        <button class="btn btn-outline-success btn-sm" onclick="exportPDF()"><i class="bi-filetype-pdf me-1"></i>Export PDF</button>
                        <button class="btn btn-outline-success btn-sm" onclick="printReceipt()"><i class="bi-receipt-cutoff me-1"></i>Receipt</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2 border rounded" id="order-invoice">
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
                                <img src="https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=invoice%3A+{{ $order->invoice }}%0Awebsite%3A+https%3A%2F%2Fclaryland.com%2Finvoice%2F{{ $order->invoice }}&amp;qzone=1&amp;margin=0&amp;size=125x125&amp;ecc=L" alt="qr code" id="qrcode" />
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-sm" id="order-customer">
                                <h6>Invoice To:</h6>
                                <p class="ms-3">
                                    {{ $order->customer_name }}<br />
                                    {{ $order->customer_contact }}<br />
                                    {{ $order->customer_email }}
                                </p>
                            </div>
                            <div class="col-sm" id="order-package">
                                <h6>Package:</h6>
                                <p class="ms-3">{{ $package->name }}</p>
                            </div>
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
                            <h3>Thank You</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function printReceipt() {
            window.open('{{ route('orders.receipt', ['order' => $order->invoice]) }}', 'Order Receipt + {{ $order->invoice }}', 'width=320,height=500');
        }

        function exportPDF() {
            window.open('{{ route('orders.invoice', ['order' => $order->invoice]) }}', 'Order Invioce + {{ $order->invoice }}', 'width=1000,height=800');
        }
    </script>
@endsection
