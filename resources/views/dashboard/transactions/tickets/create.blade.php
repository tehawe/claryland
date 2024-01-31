@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>Ticket Create<br />{{ $invoice }}</h3>
                <div id="show-data-ticket"></div>
                <div class="text-center py-3">
                    <a href="{{ route('orders.show', ['order' => $invoice]) }}" role="button" class="btn btn-sm btn-warning"><i class="bi-box-arrow-in-left me-1"></i>Back to Transactions</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            show();
        });

        function show() {
            $.get('/transactions/orders/{{ $invoice }}/ticket/show', function(data, status) {
                $('#show-data-ticket').html(data);
            });
        }
    </script>
@endsection
