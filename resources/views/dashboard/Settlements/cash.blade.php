@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md">
                <h3>Settlement</h3>
                <h5>Payment with Cash</h5>
                <div class="row">
                    <div class="col-sm">
                        <form id="settlementForm">
                            <input type="number" id="cash_in" name="cash_in" placeholder="Cash In">
                            <input type="number" id="cash_out" name="cash_out" placeholder="Cash Out">
                            <textarea rows="3" placeholder="Descriptions"></textarea>
                            <button type="submit"></button>
                        </form>
                    </div>
                    <div class="col-md"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
