@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid no-print">
        <div class="row">
        </div>
        <div class="row">
            <div class="col">
                <div class="row d-flex justify-content-between">
                    <h2 class="col-md my-1">Invoice</h2>
                    <div class="col-md d-flex my-1 mb-3 justify-content-center">
                        @can('admin')
                            @if ($order->created_at > $settlement->created_at)
                                <a href="{{ route('orders.update', ['order' => $order->invoice]) }}" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-square me-1"></i>Update Trancasctions</a>
                            @endif
                        @endcan
                        @if ($order->package_id || $items->whereIn('product_id', [1, 2, 3])->count())
                            <form action="{{ route('orders.ticket.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="invoice" id="invoice" value="{{ $order->invoice }}">
                                <button type="submit" class="btn btn-outline-success btn-sm me-1"><i class="bi-ticket-detailed me-1"></i>Create Ticket</button>
                            </form>
                        @endif
                        <div>
                            <button class="btn btn-outline-success btn-sm" onclick="exportPDF()"><i class="bi-filetype-pdf me-1"></i>Export PDF</button>
                            <button class="btn btn-outline-success btn-sm" onclick="printReceipt()"><i class="bi-receipt-cutoff me-1"></i>Receipt</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col p-2 border rounded" id="order-invoice">
                        <div class="row justify-content-between">
                            <div class="col-sm-6">
                                <img src="/img/claryland-text.png" id="logo" width="300" style="margin: auto auto 1rem auto;" />
                                <p>
                                    Jatinangor Town Square (JATOS)
                                    <br />Jl. Raya Jatinangor No.150, Cikeruh, Kec. Jatinangor, Kabupaten Sumedang, Jawa Barat 45363
                                </p>
                                <h5>{{ date_format($order->created_at, 'd-M-Y H:i') }}</h5>
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
                                <p class="ms-3">{{ $package === null ? 'Custom Order' : $package->name }}</p>
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
                                            <td>
                                                {{ $item->product->name }}<br />
                                                @if ($item->product_id == 1 || $item->product_id == 2 || $item->product_id == 3)
                                                    <span style="font-size: 0.85rem;">(
                                                        @foreach ($tickets->where('product_id', $item->product_id) as $ticket)
                                                            {{ $ticket->ticket_code }}
                                                        @endforeach
                                                        )
                                                    </span>
                                                @endif
                                            </td>
                                            <td align="right">{{ 'Rp ' . number_format($item->price) }}</td>
                                            <td align="right">{{ $item->qty }}</td>
                                            <td align="right">{{ 'Rp ' . number_format($item->qty * $item->price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-success">

                                    <tr align="right">
                                        <th colspan="4">Total</th>
                                        @if ($order->payment_method == 'cash')
                                            <th>{{ 'Rp ' . number_format($order->total) }}</th>
                                        @else
                                            <th>{{ 'Rp ' . number_format($order->amount) }}</th>
                                        @endif
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
        </div>
    </div>
    <script>
        function printReceipt() {
            window.open(`{{ route('orders.receipt', ['order' => $order->invoice]) }}`, `Order Receipt + {{ $order->invoice }}`, `width=320,height=500`);
        }

        function exportPDF() {
            window.open(`{{ route('orders.invoice', ['order' => $order->invoice]) }}`, `Order Invioce + {{ $order->invoice }}`, `width=1000,height=800`);
        }
    </script>
@endsection
