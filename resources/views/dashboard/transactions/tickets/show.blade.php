<table class="table table-sm">
    <thead class="table-info">
        <tr>
            <th>No</th>
            <th>Ticket Type</th>
            <th>Name</th>
            <th>Age</th>
            <th>Ticket Code</th>
            <th>Check-In</th>
            <th></th>
        </tr>
    </thead>
    <tbody class="data-ticket">
        @foreach ($tickets as $ticketProduct)
            <tr>
                <td colspan="7" class="table-info"></td>
            </tr>
            @foreach ($ticketProduct as $ticket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="product" data-product="{{ $ticket->product->name }}">{{ $ticket->product->name . ' (' . $loop->iteration . ') ' }}</td>
                    <td>{{ $ticket->name != null ? $ticket->name : '' }}</td>
                    <td>{{ $ticket->age != null ? $ticket->age : '' }}</td>
                    <td>{{ $ticket->ticket_code != null ? $ticket->ticket_code : '' }}</td>
                    <td>{{ $ticket->created_at != $ticket->updated_at ? $ticket->updated_at->format('d/m/Y H:i') : '' }}</td>
                    <td><button type="button" data-id="{{ $ticket->id }}" class="btn-update btn btn-success btn-sm"><i class="bi-box-arrow-in-up-right me-1"></i>Check-In</button></td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>

<div class="modal fade" id="modal-ticket" tabindex="-1" aria-labelledby="modal-ticket" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modal-title"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formCheckIn">
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text"><i class="bi-pencil"></i></span>
                        <div class="form-floating">
                            <input type="text" name="name" id="name" class="form-control" />
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text"><i class="bi-123"></i></span>
                        <div class="form-floating">
                            <input type="number" name="age" id="age" class="form-control" />
                            <label for="name">Age</label>
                        </div>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <span class="input-group-text"><i class="bi-qr-code-scan"></i></span>
                        <div class="form-floating">
                            <input type="text" name="ticket_code" id="ticket_code" class="form-control" required />
                            <label for="name">Ticket Code</label>
                        </div>
                    </div>
                    <button type="submit" id="btn-check-in" class="btn btn-success btn-sm w-100"><i class="bi-box-arrow-in-up-right me-1"></i>Check In</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.data-ticket').on('click', '.btn-update', function(e) {
            e.preventDefault();
            let ticketId = $(this).data('id');

            $.get('/transactions/orders/{{ $invoice }}/ticket/' + ticketId + '/getTicket', function(response, status) {
                let ticket = response.data;
                const name = ticket.name ? ticket.name : '';
                const age = ticket.age ? ticket.age : '';
                const ticketCode = ticket.ticket_code ? ticket.ticket_code : '';

                $('.modal-title').html('Update ' + ticket.product_name);
                $('#name').val(name);
                $('#age').val(age);
                $('#ticket_code').val(ticketCode);
                $('.modal').modal('show');

                $('#formCheckIn').submit(function(e) {
                    e.preventDefault();
                    let formData = $(this).serialize();
                    $.ajax({
                        url: '/transactions/orders/{{ $invoice }}/ticket/' + ticketId + '/update',
                        method: 'GET',
                        data: formData,
                        success: function() {
                            $('.btn-close').click();
                            show();
                        }
                    });
                });

            });
        });
    });

    function closeModal() {
        $('#formCheckIn').reset();
        $('.modal').modal('hide');
    }
</script>
