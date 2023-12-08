@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2>Invoice</h2>
                <div>
                    <button class="btn btn-success" id="btn-print"><i class="bi-printer me-1"></i>Print</button>
                    <div id="display"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
