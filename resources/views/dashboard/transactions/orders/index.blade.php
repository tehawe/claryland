@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 me-2 border rounded py-3 mb-3 bg-primary bg-gradient bg-opacity-10">
                <h3 class="border-bottom pb-3">Ticket Order (#{{ $invoice }})</h3>
                <form action="{{ route('orders.store', ['order' => $invoice]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="invoice" id="invoice" value="{{ $invoice }}">
                    <div class="mb-3 form-floating">
                        <div class="col mb-3 form-floating">
                            <select name="package_id" id="package_id" class="form-select" required>
                                <option value="">- Select Package -</option>
                                @foreach ($packages as $package)
                                    <option value="{{ $package->id }}">{{ $package->name }} => (Rp {{ number_format($package->price) }})</option>
                                @endforeach
                            </select>
                            <label for="package_id" class="form-label">Package</label>
                        </div>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Customer Name">
                        <label for="customer_name" class="form-label">Customer Name</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="number" class="form-control" id="customer_contact" name="customer_contact" placeholder="Contact">
                        <label for="customer_contact" class="form-label">Contact</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="email" class="form-control" id="customer_email" name="customer_email" placeholder="Email">
                        <label for="customer_email" class="form-label">Email</label>
                    </div>


                    <div class="my-3 mb-3 d-flex justify-content-center">
                        <button class="btn btn-warning btn-sm me-1"><i class="bi-arrow-left-square me-1"></i>Cancel</button>
                        <button class="btn btn-primary btn-sm"><i class="bi-check-square me-1"></i>Create Ticket Order</button>
                    </div>
                </form>
            </div>
            <div class="col me-1">
                <form action="{{ route('orders.custom.store', ['order' => $invoice]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="invoice" id="invoice" value="{{ $invoice }}">
                    <div class="my-3 mb-3 d-flex justify-content-center">
                        <button class="btn btn-info btn-sm my-auto fs-2 p-3"><i class="bi-basket2 me-1"></i>Create Custom Order</button>
                    </div>
                </form>
            </div>

        </div>
        <div class="row">
            @if ($pendingOrders->count())
                <div class="col me-1 py-3 mb-3 border border-warning rounded">
                    <h2>Unpaid Order</h2>
                    <table class="table" id="data-table">
                        <thead class="table-warning">
                            <tr>
                                <th>No</th>
                                <th>Create At</th>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Items</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingOrders as $pendingOrder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ date_format($pendingOrder->created_at, 'd/m/Y') }}</td>
                                    <td>{{ $pendingOrder->invoice }}</td>
                                    <td>{{ $pendingOrder->customer_name }}</td>
                                    <td>{{ $pendingOrder->items_sum_qty }}</td>
                                    <td>
                                        <a href="@if ($pendingOrder->package_id !== null) {{ route('orders.create', ['order' => $pendingOrder->invoice]) }}@else{{ route('orders.custom.create', ['order' => $pendingOrder->invoice]) }} @endif" class="btn btn-sm btn-warning me-1"><i class="bi-pencil-square me-1"></i>Update</a>
                                        <a href="{{ route('orders.cancel', ['order' => $pendingOrder->invoice]) }}" onclick="confirm('Are you sure want to cancel this Order {{ $pendingOrder->invoice }} ?')" class="btn btn-danger btn-sm"><i class="bi-trash me-1"></i>Cancel</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <script>
        let table = new DataTable('#data-table');
    </script>
@endsection
