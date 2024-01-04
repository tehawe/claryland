@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid pb-5 mb-5">
        <div class="row">
            <div class="col-md">
                <h2 class="border-bottom pb-3 mb-3">Settlement - {{ $data->code }}</h2>
                <div class="row">
                    <div class="col-sm-6">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <table class="table table-sm">
                            <tr>
                                <td>Name</td>
                                <td>: {{ $data->name }}</td>
                            </tr>
                            <tr>
                                <td>Code</td>
                                <td>: {{ $data->code }}</td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td>: {{ Str::upper($data->payment_method) }}</td>
                            </tr>
                            <tr>
                                <td>Cash In</td>
                                <td>: Rp {{ number_format($data->cash_in) }}</td>
                            </tr>
                            <tr>
                                <td>Cash Out</td>
                                <td>: Rp {{ $data->cash_out ? number_format($data->cash_out) : 0 }}</td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>: {{ $data->cash_note }}</td>
                            </tr>
                            <tr>
                                <td>Sales</td>
                                <td>: {{ $data->sales->name }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:
                                    @if ($data->status === null)
                                        <span class="p-1 px-2 rounded bg-warning text-dark">Waiting for Check</span>
                                    @elseif($data->status === 0)
                                        <span class="p-1 px-2 rounded bg-danger text-light">Reject</span>
                                    @else
                                        <span class="p-1 px-2 rounded bg-success text-light">Approved</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Created at</td>
                                <td>: {{ date_format($data->created_at, 'd/m/Y H:i') }}</td>
                            </tr>

                            @if ($data->status !== null)
                                <tr>
                                    <td>Checker</td>
                                    <td>: {{ $data->checkers->name }}</td>
                                </tr>
                                <tr>
                                    <td>Reason</td>
                                    <td>: {{ $data->reason ? $data->reason : '-' }}</td>
                                </tr>
                                <tr>
                                    <td>Update at</td>
                                    <td>: {{ date_format($data->updated_at, 'd/m/Y H:i') }}</td>
                                </tr>
                            @endif
                        </table>
                        @can('admin')
                            <div class="text-center">
                                <a href="{{ route('settlements') }}" class="btn btn-secondary btn-sm"><i class="bi-arrow-left me-1"></i>Back</a>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#modal-settlement-update" class="btn btn-warning btn-sm"><i class="bi-pencil-square me-1"></i>Update</button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="modal-settlement-update" tabindex="-1" aria-labelledby="modal-settlement-update" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Settlement - Update</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('settlements.update', ['settlement' => $data->code]) }}" id="form-settlement-update" method="POST">
                                                @csrf
                                                @method('patch')
                                                <div class="my-3 text-center">
                                                    <h6>Settlement Status</h6>
                                                    <input type="radio" class="btn-check" name="status" id="reject" autocomplete="off" value="0" {{ $data->status == '0' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-danger btn-sm" for="reject"><i class="bi-x-circle me-1"></i>Reject</label>
                                                    <input type="radio" class="btn-check" name="status" id="approve" autocomplete="off" value="1" {{ $data->status == '1' ? 'checked' : '' }}>
                                                    <label class="btn btn-outline-success btn-sm" for="approve"><i class="bi-check2-circle me-1"></i>Approve</label>
                                                    <div class="form-floating my-3 wrap-reason">
                                                        <textarea class="form-control" placeholder="Leave reason why you reject" name="reason" id="reason" style="height: 100px">{{ $data->reason ? $data->reason : '' }}</textarea>
                                                        <label for="reason">Reason</label>
                                                    </div>
                                                    <button type="reset" class="btn btn-secondary btn-sm"><i class="bi-x-square me-1"></i>Reset</button>
                                                    <button type="submit" class="btn btn-warning btn-sm"><i class="bi-check2-square me-1"></i>Confirm</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan


                    </div>
                </div>
            </div>
        </div>
    @endsection
