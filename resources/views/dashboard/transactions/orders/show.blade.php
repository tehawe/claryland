@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="Orders">
        @if (session()->has('order'))
            <h1>Order (#{{ session('order')->invoice }})</h1>
            <div class="row">
                <div class="col-md-5">
                    <h5>Add Item</h5>
                    <div class="row">
                        <div class="col-sm-8">Item Name</div>
                        <div class="col-sm-4">Qty</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <h4>Metode Pembayaran</h4>
                    <div class="form-check form-check-floating">
                        <label class="form-check-label" for="cash">Cash</label>
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cash" required>
                    </div>
                    <div class="mb-3 form-floating" id="amount-input">
                        <input type="email" class="form-control" id="amount" name="amount" placeholder="Amount">
                        <label for="payment" class="form-label">Amount</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="cashless" required>
                        <label class="form-check-label" for="cashless">Cashless</label>
                    </div>
                </div>
                <div class="col-md-3">
                    <h6>Order #order_number</h6>

                    <ul id="order-item-info">
                        <li><span class="key">Ticket</span><span class="qty"></span></li>
                        <li></li>
                        <li></li>
                    </ul>
                    <hr />
                    <ul id="order-payment-info">
                        <li class="row justify-content-between"><span class="col key">Grand Total</span><span class="col qty">Rp 250.000</span></li>
                        <li class="row justify-content-between"><span class="col key">Tunai</span><span class="col qty">Rp 300.000</span></li>
                        <li class="row justify-content-between"><span class="col key">Grand Total</span><span class="col qty">Rp 1.xxx.xxx</span></li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
