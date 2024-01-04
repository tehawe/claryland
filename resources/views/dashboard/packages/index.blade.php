@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="border-bottom pb-3 mb-3">Packages</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a href="{{ route('packages.create') }}" class="btn btn-sm btn-primary"><i class="bi-plus-square me-1"></i>Add Package</a>
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show my-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="border border-info p-2 my-2 rounded">
                    <table class="table table-sm table-hover" id="data-table">
                        <thead class="table-info">
                            <tr>
                                <th>No</th>
                                <th>Package Name</th>
                                <th>Price</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                                <tr @if (!$package->status) class="table-danger" @endif>
                                    <td align="right">{{ $loop->iteration }}</td>
                                    <td> <span tabindex="0" data-bs-toggle="popover" data-bs-trigger="focus" data-bs-title="Description" data-bs-content="{{ $package->description }}">{{ $package->name }}</span></td>
                                    <td align="right">Rp {{ number_format($package->price) }}</td>
                                    <td align="center">{{ $package->start_date ? date_format(new DateTime($package->start_date), 'd-M-Y') : null }}</td>
                                    <td align="center">{{ $package->end_date ? date_format(new DateTime($package->end_date), 'd-M-Y') : null }}</td>
                                    <td>{{ $package->status ? 'Active' : 'Deactive' }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-warning btn-sm" href="{{ route('packages.edit', ['package' => $package->id]) }}"><i class="bi-pencil-square me-1"></i>Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Datatable
        let table = new DataTable('#data-table');

        //Popover
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
        const popover = new bootstrap.Popover('.popover-dismiss', {
            trigger: 'focus'
        })
    </script>
@endsection
