@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h1>Settlement</h1>
                <form action="">
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" id="cashIn" name="cashIn" placeholder="Cash In">
                        <label for="cashIn" class="form-label">Cash In</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" id="cashOut" name="cashOut" placeholder="Cash Out">
                        <label for="cashOut" class="form-label">Cash Out</label>
                    </div>
                    <button type="button" class="btn btn-primary">Sumbit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
