    <div class="header">
        <button onclick="window.print()">Print</button>
    </div>
    <div id="receipt-print" align="center" style="max-width:300px; margin:10px auto;">
        <div id="header" style="border-bottom:1px #000 dotted;">
            <h2>LOGO Claryland</h2>
            <h4>JATOS Lt.x</h4>
            <p align="center">Address | Contact<br />
                www.claryland.com
            </p>
        </div>
        <div id="transaction">
            <div id="user-info" class="row d-flex justify-content-between">
                <span class="col">{{ date_format($order->updated_at, 'd/m/Y H:i') }}</span>
                <span class="col">Cashier: {{ Auth::user()->name }}</span>
            </div>

            <div id="item">
                <table>
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td align="right">{{ number_format($item->price) }}</td>
                                <td align="right">x {{ $item->qty }}</td>
                                <td align="right">{{ number_format($item->price * $item->qty) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th align="right">Total</th>
                            <th></th>
                            <th align="right">{{ 'Rp ' . number_format($order->total) }}</th>
                        </tr>
                        <tr>
                            <th colspan="2" align="right">
                                @switch($order->payment_method)
                                    @case('card')
                                        {{ str()->ucfirst($order->payment_method) }}<br />
                                        <span style="font-size: 0.75rem;">{{ str($order->card_number)->mask('*', 0, -4) }}</span>
                                    @break

                                    @case('qris')
                                        {{ str()->ucfirst($order->payment_method) }}
                                    @break

                                    @default
                                        {{ str()->ucfirst($order->payment_method) }}
                                @endswitch
                            </th>
                            <th></th>
                            <th align="right">{{ 'Rp ' . number_format($order->amount) }}</th>
                        </tr>
                        <tr>
                            <th></th>
                            <th align="left">{{ $order->payment_method == 'cash' ? 'Change' : '' }}</th>
                            <th></th>
                            <th align="right">{{ $order->amount - $order->total > 0 ? 'Rp ' . number_format($order->amount - $order->total) : '-' }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <hr />
        <div id="order">
            <div id="customer-detail">
                {{ $order->customer_name }}<br />{{ $order->customer_contact }}<br />{{ $order->customer_email }}
            </div>
        </div>
        <img src="https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=http%3A%2F%2Fclaryland.com%2Freceipt%2F{{ $order->invoice }}&amp;qzone=1&amp;margin=0&amp;size=100x100&amp;ecc=L" alt="qr code" /><br />
        #{{ $order->invoice }}<br />
    </div>
