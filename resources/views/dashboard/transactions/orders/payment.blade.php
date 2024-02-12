@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="Orders">
        <div class="row">
            <h2><i class="bi-"></i>Order (#{{ $invoice }})</h2>
            <h4 class="py-2 border-bottom">Order Confirmation</h4>
            <p>Please reconfirm the order details with the customer and provide the total purchase amount.</p>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">#{{ $invoice }}</h5>
                        @if ($customer['name'] !== null)
                            <div class="card-text row">
                                <div class="col"><i class="bi-person-square d-block"></i>{{ $customer['name'] }}</div>
                                <div class="col"><i class="bi-phone d-block"></i>{{ $customer['contact'] }}</div>
                                <div class="col"><i class="bi-envelope-at d-block"></i>{{ $customer['email'] }}</div>
                            </div>
                        @endif
                        <table class="table table-bordered">
                            <thead class="table-secondary">
                                <tr class="text-center">
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody class="data-item">
                                {{-- data item --}}
                            </tbody>
                            <tfoot>
                                <tr class="table-secondary">
                                    <th colspan="3" class="text-end">Total</th>
                                    <th class="total-item text-end"></th>
                                </tr>
                            </tfoot>
                        </table>
                        <a href="{{ !$package ? route('orders.custom.create', ['order' => $invoice]) : route('orders.create', ['order' => $invoice]) }}" role="button" class="btn btn-warning d-block"><i class="bi-arrow-left-square me-1"></i>Update Order</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 border border-success rounded pb-3 mb-5">
                <h4 class="py-2 border-bottom">Payment Method</h4>
                <p>Select one of the payment methods provided</p>
                <form id="formPayment" action="{{ route('orders.payment.process', ['order' => $invoice]) }}" method="POST">
                    @method('patch')
                    @csrf
                    <div class="border border-success text-success rounded p-1 mb-3">
                        <span class="text-center d-block fs-5">Total (Rp)</span>
                        <input type="number" class="total border-0 text-center text-success fs-3 w-100 form-control-plaintext" name="total" id="total" style="border-none;" readonly>
                    </div>
                    <div class="form-check mb-3">
                        <label class="form-check-label" for="cash"><i class="bi-cash-coin me-1"></i>Cash</label>
                        <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cash" required @if ($payment_method) checked @endif>
                    </div>
                    <!--
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="card" value="card" required>
                            <label class="form-check-label" for="card"><i class="bi-credit-card me-1"></i>Card (Debit / Credit)</label>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="payment_method" id="qris" value="qris">
                            <label class="form-check-label" for="qris"><i class="bi-qr-code me-1"></i>QRIS</label>
                        </div>
                    -->

                    <div class="mb-3 form-floating" id="card-input">
                        <input type="text" class="form-control" id="card_number" name="card_number" placeholder="Card Number" maxlength="19" minlength="16">
                        <label for="amount" class="form-label">Card Number</label>
                    </div>
                    <div class="mb-3 form-floating" id="amount-input">
                        <input type="number" class="form-control text-end" id="amount" name="amount" placeholder="Amount">
                        <label for="amount" class="form-label">Amount</label>
                    </div>
                    <div class="mb-3 form-floating" id="change-input">
                        <input type="number" class="form-control text-end" id="change" name="change" placeholder="Change">
                        <label for="amount" class="form-label">Change</label>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success w-100 my-3"><i class="bi-wallet2 me-1"></i>Confirm Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="modal-alert" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-warning">
                    <p>Amount value cannot less than total value.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        const dataItems = document.querySelector('.data-item');
        const totalItem = document.querySelector('.total-item');
        const totalPayment = document.querySelector('#total');

        fetch('/orders/' + {{ $id }} + '/item')
            .then(response => response.json())
            .then(response => {
                // Get List Items
                const items = response.data;
                let container = '';
                items.forEach(item => container += dataItem(item));
                dataItems.innerHTML = container;
                // Get Total Price
                let total = 0;
                for (let i in items) {
                    total += items[i].price * items[i].qty;
                }
                totalItem.innerHTML = currencyFormat(total);
                totalPayment.value = total;
            })
            .catch(error => console.log(error));


        // Display Item
        function dataItem(item) {
            return `<tr>
                        <td>` + item.product_name + `</td>
                        <td align="right">` + currencyFormat(item.price) + `</td>
                        <td align="right">x ` + item.qty + `</td>
                        <td align="right">` + currencyFormat(item.qty * item.price) + `</td>
                </tr>`;
        }

        function currencyFormat(num) {
            return 'Rp ' + num.toLocaleString('id-ID', 'decimal');
        }

        $(document).ready(function() {
            $('#total').attr('required', true).attr('readonly', true).show();

            @if ($amount)
                $('#amount-input').show();
                $('#amount').attr('disabled', false).attr('required', true);
                $('#amount').val('{{ $amount }}');
                $('#change-input').show();
                $('#change').val('{{ $amount - $total }}');
            @else
                $('#amount-input').hide();
                $('#amount').attr('disabled', true).attr('required', false);
            @endif

            $('#card-input').hide();
            $('#card-number').attr('disabled', true).attr('required', false);

            $('#change-input').hide();
            $('#change').attr('disabled', true).attr('required', false);


            $('#cash').click(function() {
                $('#amount-input').show();
                $('#amount').attr('disabled', false).attr('required', true);
                $('#amount').val('@if ($amount){{ $amount }}@endif');
                $('#change-input').show();

                $('#card-input').hide();
                $('#card_number').attr('disabled', true).attr('required', false);
            });

            $('#card').click(function() {
                $('#amount').val(total);
                $('#amount').attr('disabled', true).attr('required', true);
                $('#amount-input').hide();

                $('#card-input').show();
                $('#card_number').attr('disabled', false).attr('required', true);

                $('#change').val('');
                $('#change').attr('disabled', true).attr('required', false);
                $('#change-input').hide();
            });

            $('#qris').click(function() {
                $('#amount').val(total);
                $('#amount').attr('disable', true).attr('required', true);
                $('#amount-input').hide();

                $('#card_number').attr('desabled', true).attr('required', false);
                $('#card-input').hide();

                $('#card-input').hide();
                $('#card_number').attr('disabled', true).attr('required', false);

                $('#change').val('');
                $('#change').attr('disabled', true).attr('required', false);
                $('#change-input').hide();
            });

            $('#amount').change(function() {
                const amountVal = $(this).val();
                const total = $('#total').val();
                const changeVal = amountVal - total;
                if (changeVal < 0) {
                    $('#modal-alert').modal('show');
                    $(this).val('');
                } else {
                    $('#change').attr('disabled', true).attr('required', true);
                    $('#change').val(changeVal);
                }
            });

            $('#card_number').change(function() {
                $(this).val();
            });

            $('#formPayment').submit(function(e) {
                console.log(this);
            });
        });
    </script>
@endsection
