@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-md">
            <h1 class="border-bottom mb-3 pb-3">Settlement</h1>

            <div class="card-group card-settlement mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h1><i class="bi-cash-coin me-1"></i></h1>
                        <h5 class="card-title">Cash</h5>
                        <p class="card-text">Settlement for all transactions using Cash payment methods</p>
                    </div>
                    <div class="card-footer text-center">
                        <button type="button" class="btn btn-success btn-settlement" data-payment="cash" id="btn-settlement-cash">Create</button>
                    </div>
                </div>
                <!--
                    <div class="card">
                        <div class="card-body text-center">
                            <h1><i class="bi-credit-card-2-front me-1"></i></h1>
                            <h5 class="card-title">Card (Debit/Credit)</h5>
                            <p class="card-text">Settlement for all transactions using the Debit / Credit Card payment method</p>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-success btn-settlement" data-payment="card" id="btn-settlement-card">Create</button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <h1><i class="bi-qr-code me-1"></i></h1>
                            <h5 class="card-title">QRIS</h5>
                            <p class="card-text">Settlement for all transactions using the QRIS payment method</p>
                        </div>
                        <div class="card-footer text-center">
                            <button type="button" class="btn btn-success btn-settlement" data-payment="qris" id="btn-settlement-qris">Create</button>
                        </div>
                    </div>
                -->
            </div>
        </div>
    </div>
    <div class="row mb-3" id="show-data">
        {{-- List settlement here --}}
    </div>
</div>

<!-- Modal -->
<div class="modal modal-settlement fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-settlement" method="POST">
                    @csrf
                    <input type="hidden" name="payment_method" id="payment_method">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        <label for="name">Name</label>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="cash_in" id="cash_in" placeholder="Cash In">
                                <label for="cash_in">Cash In</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" name="cash_out" id="cash_out" placeholder="Cash Out">
                                <label for="cash_out">Cash Out</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-5">
                        <textarea name="cash_note" id="cash_note" class="form-control" placeholder="Cash Note" style="height: 100px"></textarea>
                        <label for="cash_out">Cash Note</label>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-secondary btn-sm btn-reset me-1" data-bs-dismiss="modal">Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm btn-submit">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Show Data
        getData();

        $('.card-settlement').on('click', '.btn-settlement', function(e) {
            e.preventDefault();
            $('.modal-title').empty();
            const payment = $(this).data('payment');
            if (payment != 'cash') {
                $('#cash_out').attr('disabled', true);
            } else {
                $('#cash_out').attr('disabled', false);
            }
            $('.modal-settlement').modal('show');
            $('#modal-title').append('Settlement for ' + payment.toUpperCase() + ' Payment');
            $('#payment_method').val(payment);

            console.log(payment);
        });

        // Form submit
        $('#form-settlement').submit(function(e) {
            e.preventDefault();
            let form = $(this);
            console.log(form.serialize());
            $.ajax({
                url: `{{ route('settlements.store') }}`,
                method: 'GET',
                data: form.serialize(),
                success: function(response) {
                    $('.btn-reset').click();
                    $('.btn-close').click();

                    getData();
                }
            });
        });

    });

    function getData() {
        $.get(`{{ route('settlements.current') }}`, function(data, status) {
            $('#show-data').html(data);
            console.log(status);
        });
    }
</script>
@endsection