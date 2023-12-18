@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h1>Ticket Create<br />{{ $invoice }}</h1>
                <div id="show-data-ticket"></div>
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
