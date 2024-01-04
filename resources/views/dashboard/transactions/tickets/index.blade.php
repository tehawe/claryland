@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <h1 class="border-bottom pb-3 mb-3">Ticket</h1>
            <div class="col-md">
                <form action="{{ route('orders.ticket.store') }}" method="POST" class="text-center mx-auto my-4 border rounded p-3">
                    @csrf
                    <h1 class="d-block"><i class="bi-qr-code-scan"></i></h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-center" name="invoice" id="invoice" placeholder="Receipt QR Code">
                        <label for="floatingInput">Scan QR Receipt</label>
                    </div>
                </form>
            </div>
            <div class="col-md text-center">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#validateModal">Validate Ticket</button>
                <div class="data-validation">{{-- contenthere!!! --}}</div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="validateModal" tabindex="-1" aria-labelledby="validateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Validate Ticket Code</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="validateForm" class="col-md-6 text-center mx-auto">
                        @csrf
                        <h1 class="d-block"><i class="bi-qr-code-scan"></i></h1>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control text-center" name="ticket_code" id="ticket_code" placeholder="Ticket Code">
                            <label for="floatingInput">Scan Ticket Code</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#invoice').focus();

            $('#validateForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('orders.ticket.validation') }}',
                    methode: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let data = response.data;
                        $('.btn-close').click();
                        $('#ticket_code').val('');
                        $('.data-validation').empty();
                        $('.data-validation').addClass('border p-3 rounded my-3').append(data.product_name + ` #` + data.ticket_code + `<br />
                        ` + data.name + ` (` + data.age + ` Thn)<br />
                        Check In at ` + data.check_in);
                    }
                });
            });
        });

        function validate(ticketCode) {

        }
    </script>
@endsection
