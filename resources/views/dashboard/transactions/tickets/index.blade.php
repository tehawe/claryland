@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <h1 class="border-bottom pb-3 mb-3">Ticket</h1>
        <div class="row">
            <div class="col mb-3 px-3">
                <div class="row gap-2">
                    <h4>Last Scanned</h4>
                    <div class="col-md text-center rounded py-2" style="background: #ff86d1;">
                        <h6>Ticket Bermain</h6>
                        <h5>{{ $ticketBermain }}</h5>
                    </div>
                    <div class="col-md text-center rounded py-2" style="background: #6bbcff;">
                        <h6>Ticket Pendamping</h6>
                        <h5>{{ $ticketPendamping }}</h5>
                    </div>
                    <div class="col-md text-center rounded py-2" style="background: #ba7dff;">
                        <h6>Ticket Pendamping (Tambahan)</h6>
                        <h5>{{ $ticketPendampingTambahan }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md border rounded bg-info bg-gradient bg-opacity-50 p-2 px-3 mx-1 mb-2">
                <form action="{{ route('orders.ticket.store') }}" method="POST" class="text-center mx-auto">
                    @csrf
                    <h1 class="d-block"><i class="bi-qr-code-scan"></i></h1>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control text-center" name="invoice" id="invoice" placeholder="Receipt QR Code">
                        <label for="floatingInput">Scan the QR code on the customer receipt</label>
                    </div>
                </form>
            </div>
            <div class="col-md border border-warning rounded bg-outline-warning bg-gradient bg-opacity-50 p-2 mx-1 mb-2">
                <p class="text-center">Validation for visitors re-entering from outside the playground area</p>
                <button type="button" class="btn btn-warning mx-auto d-flex" data-bs-toggle="modal" data-bs-target="#validateModal">Validate Ticket</button>
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
                        $('.data-validation').addClass('border p-2 rounded my-3 bg-warning bg-opacity-50').append(data.product_name + ` #` + data.ticket_code + `<br />
                        ` + data.name + ` (` + data.age + ` Thn)<br />
                        Check In at ` + data.check_in + `<hr />
                        <h5>Order Information</h5>Invoice:<br />` + data.invoice + `<br /><br />Name:<br />` + data.customer_name + `<br /><br />Contact:<br />` + data.customer_contact + `<br /><br />Order at ` + data.order_date);
                    }
                });
            });
        });

        function validate(ticketCode) {

        }
    </script>
@endsection
