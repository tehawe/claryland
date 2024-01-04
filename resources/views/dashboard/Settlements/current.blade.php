<div class="col-md border-top p-3 py-3">
    @if (!$settlements->count())
        <div class="bg-warning rounded p-3 text-center">
            <h5>There is no settlement data yet</h5>
        </div>
    @else
        <table class="table table-sm table-hover table-bordered data-table">
            <thead class="table-info">
                <tr align="center">
                    <th>No</th>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Payment Method</th>
                    <th>Cash In</th>
                    <th>Cash Out</th>
                    <th>Status</th>
                    <th>Reason</th>
                    <th>Sales</th>
                    <th>Checker</th>
                    <th>Created</th>
                    @can('admin')
                        <th></th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($settlements as $settlement)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $settlement->code }}</td>
                        <td>{{ $settlement->name }}</td>
                        <td>{{ $settlement->payment_method }}</td>
                        <td align="right">{{ 'Rp ' . number_format($settlement->cash_in) }}</td>
                        <td align="right">{{ 'Rp ' . number_format($settlement->cash_out) }}</td>
                        @if ($settlement->status === null)
                            <td class="bg-warning text-center">Waiting for check</td>
                        @elseif($settlement->status == 0)
                            <td class="bg-danger text-center text-light">Reject</td>
                        @else
                            <td class="bg-success text-center text-light">Approve</td>
                        @endif
                        <td>{{ $settlement->reason }}</td>
                        <td>{{ $settlement->sales->name }}</td>
                        <td>{{ $settlement->checkers !== null ? $settlement->checkers->name : '' }}</td>
                        <td>{{ date_format($settlement->created_at, 'd-M-Y H:i') }}</td>
                        @can('admin')
                            <td><a href="{{ route('settlements.show', ['settlement' => $settlement->code]) }}" class="btn btn-sm btn-primary"><i class="bi-box-arrow-in-right me-1"></i>Check</a></td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<script>
    let table = new DataTable('.data-table');
</script>
