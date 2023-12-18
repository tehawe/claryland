@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Ticket</h1>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice</th>
                            <th>Ticket Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->invoice }}</td>
                                <td>{{ $order->items_sum_qty }}</td>
                                <td><button class="btn btn-outline-primary btn-sm">Create</button></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
