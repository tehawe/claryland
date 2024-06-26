<style>
    @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@400&family=Roboto:ital,wght@0,400;0,500;0,900;1,400;1,500;1,900&display=swap');

    #receipt-print {
        text-align: center;
        max-width: 300px;
        margin: auto auto 3px 1px;
    }

    #receipt-print>* {
        font-family: 'Inconsolata';
    }

    hr.line {
        clear: both;
        border: 1.5px dashed #000;
    }

    #receipt-print #header #logo {
        width: 200px;
    }

    #receipt-print #header #location {
        font-size: 0.75rem;
        font-weight: bold;
    }

    #receipt-print #header #address,
    #receipt-print #header #contact {
        font-size: 0.75rem;
    }

    #receipt-print #body #info {
        display: inline-block;
        margin: 0.5rem auto;
        width: 100%;
        font-size: 0.85rem;
    }

    #receipt-print #body #info #invoice {
        display: block;
        text-align: center;
        font-weight: bolder;
    }

    #receipt-print #body #info #datetime {
        display: block;
        text-align: center;
    }

    #receipt-print #body #info #cashier {
        display: block;
        margin-top: 0.25rem;
        text-align: left;
    }

    #receipt-print #body #item {
        clear: both;
        margin-top: 0.5rem;
    }

    #receipt-print #body #item table {
        width: 100%;
        font-size: 0.80rem;
    }

    #receipt-print #body #item table thead tr td {
        border-bottom: 2px dotted #000;
    }

    #receipt-print #footer {
        clear: both;
        width: 100%;
        display: inline-block;
        margin: 0.5rem auto;
    }

    #receipt-print #footer #customer {
        display: block;
        text-align: center;
        font-size: 0.8rem;
    }

    #receipt-print #footer #qrcode {
        display: block;

        margin: 0.5rem auto;
    }

    #receipt-print #footer #note {
        clear: both;
    }

    @media print {
        .btn-print {
            display: none;
        }
    }
</style>

<div id="receipt-print">
    <button class="btn-print" onclick="window.print()">Print</button>
    <div id="header">
        <img src="/img/claryland-text-bw.png" id="logo" />
        <p id="location">Jatinangor Town Square<br />(JATOS) Lt. SF</p>
        <p id="address">Jl. Raya Jatinangor No.150</p>
        <p id="contact">www.clarylandplayground.com</p>
    </div>
    <div id="body">
        <div id="info">
            <span id="invoice">Receipt - #{{ $order->invoice }}</span>
            <span id="datetime">{{ date_format($order->updated_at, 'd/m/Y') . ' ' . date_format($order->updated_at, 'H:i') }}</span>
            <span id="cashier">{{ 'Cashier: ' . $order->user->name }}</span>
        </div>
        <hr class="line">
        <div id="item">
            <table cellpadding="1" cellspacing="0">
                <thead>
                    <tr align="center" style="font: bolder;">
                        <th>Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Sub Total</th>
                    </tr>
                    <tr>
                        <th colspan="4">
                            <hr class="line" />
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr valign="top">
                            <td>{{ $item->product->name }}</td>
                            <td align="right">{{ number_format($item->price) }}</td>
                            <td align="right">{{ 'x' . $item->qty }}</td>
                            <td align="right">{{ number_format($item->price * $item->qty) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <hr class="line">
                        </th>
                    </tr>
                    <tr align="right">
                        <th></th>
                        <th>Total</th>
                        @if ($order->payment_method == 'cash')
                            <th colspan="2">{{ 'Rp ' . number_format($order->total) }}</th>
                        @else
                            <th colspan="2">{{ 'Rp ' . number_format($order->amount) }}</th>
                        @endif
                    </tr>
                    <tr align="right">
                        <th colspan="2">Pay with
                            @switch($order->payment_method)
                                @case('card')
                                    {{ str()->ucfirst($order->payment_method) }}<br />
                                    <span style="font-size: 0.75rem;">{{ str($order->card_number)->mask('*', 0, -4) }}</span>
                                @break

                                @case('qris')
                                    {{ str()->upper($order->payment_method) }}
                                @break

                                @default
                                    {{ str()->ucfirst($order->payment_method) }}
                            @endswitch
                        </th>
                        <th colspan="2">{{ 'Rp ' . number_format($order->amount) }}</th>
                    </tr>
                    @if ($order->payment_method === 'cash')
                        <tr align="right">
                            <th></th>
                            <th>Change</th>
                            <th colspan="2">{{ 'Rp ' . number_format($order->amount - $order->total) }}</th>
                        </tr>
                    @endif
                </tfoot>
            </table>
        </div>
    </div>
    <hr class="line">
    <div id="footer">
        <img src="https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data={{ $order->invoice }}&amp;qzone=1&amp;margin=0&amp;size=85x85&amp;ecc=M" alt="{{ $order->invoice }}" id="qrcode" />
        <div id="customer">
            {{ $order->customer_name }}<br />{{ str($order->customer_contact)->mask('*', 4, -4) }}<br />{{ $order->customer_email }}
        </div>
        <h6 id="note">To prove the validity of this ticket, you can scan this QR Code.</h6>
        <hr />
    </div>
</div>
