@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="Orders">
        <h1>Order</h1>
        <div class="row">
            <form action="" class="col-md-6">
                @csrf
                <div class="mb-3 form-floating">
                    <div class="col mb-3 form-floating">
                        <select name="age" id="age" class="form-select">
                            <option>- Pilih Paket -</option>
                            @foreach ($packages as $package)
                                <option value="{{ $package->id }}">{{ $package->name }}</option>
                            @endforeach
                        </select>
                        <label for="age" class="form-label ms-2">Paket</label>
                    </div>
                </div>
                <div class="mb-3 form-floating">
                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name">
                    <label for="customer_name" class="form-label">Customer Name</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="number" class="form-control" id="customer_contact" name="customer_contact" placeholder="Contact">
                    <label for="customer_contact" class="form-label">Contact</label>
                </div>
                <div class="mb-3 form-floating">
                    <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email">
                    <label for="customer_email" class="form-label">Email</label>
                </div>

                <h4>Metode Pembayaran</h4>
                <div class="form-check">
                    <label class="form-check-label" for="tunai">Tunai</label>
                    <input class="form-check-input" type="radio" name="paymentMethod" id="tunai" required>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="nonTunai" required>
                    <label class="form-check-label" for="nonTunai">Non Tunai</label>
                </div>

            </form>
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
    </div>
@endsection
