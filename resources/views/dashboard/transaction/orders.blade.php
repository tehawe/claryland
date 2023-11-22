@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="Orders">
        <h1>Order</h1>
        <form action="" class="col-md-6">
            <div class="mb-3 form-floating">
                <input type="text" class="form-control" id="childCompanion" name="childCompanion" placeholder="Nama Orang Tua / Pendamping">
                <label for="childCompanion" class="form-label">Nama Orang Tua / Penamping</label>
            </div>
            <div class="mb-3 col-md-2 form-floating">
                <input type="number" class="form-control" id="qty" name="qty" placeholder="Qty" required>
                <label for="qty" class="form-label">Qty</label>
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

            <div class="mb-3 form-floating">
                <input type="text" class="form-control" id="childName" name="childName" placeholder="Nama Anak">
                <label for="childName" class="form-label">Nama Anak</label>
            </div>
            <div class="mb-3 form-floating">
                <select name="age" id="age" class="form-select">
                    <option>- Pilih Usia -</option>
                    @for ($i = 1; $i <= 12; $i++)
                        <option value={{ $i }}>{{ $i }}</option>
                    @endfor
                </select>
                <label for="age" class="form-label">Usia</label>
            </div>
        </form>
    </div>
@endsection
