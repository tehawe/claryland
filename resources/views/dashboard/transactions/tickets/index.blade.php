@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Ticket</h1>
                @foreach ($orders as $order)
                    {{ $order->invoice }}
                @endforeach
            </div>
        </div>
    </div>
@endsection
