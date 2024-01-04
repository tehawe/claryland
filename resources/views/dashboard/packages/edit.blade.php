@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h2 class="mb-3 pb-3 border-bottom">Create Package</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <form action="{{ route('packages.update', ['package' => $package]) }}" method="POST" class="text-center form-control-sm w-50">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Package Name" value="{{ $package->name }}" required>
                        <label for="name">Package Name</label>
                    </div>
                    <div class="form-floating mb-3 w-25">
                        <input type="number" class="form-control" name="price" id="price" placeholder="Package Price (Rp)" value="{{ $package->price }}" min="0" minlength="4" required>
                        <label for="price">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a description here" name="description" id="description" style="height: 100px">{{ $package->description }}</textarea>
                        <label for="description">Description</label>
                    </div>
                    <div class="row">
                        <div class="col form-floating mb-3">
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ $package->start_date ? $package->start_date : null }}" placeholder="Start Date">
                            <label for="start_date" class="ms-2">Start Date</label>
                        </div>
                        <div class="col form-floating mb-3">
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ $package->end_date ? $package->end_date : null }}" placeholder="End Date">
                            <label for="end_date" class="ms-2">End Date</label>
                        </div>
                    </div>
                    <div class="form-floating d-flex justify-content-start px-2 pt-1 mb-3 border border-warning rounded">
                        <span class="fs-6 me-3">Status</span>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input" type="radio" name="status" id="active" value="1" {{ $package->status ? 'checked' : '' }} required>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check form-check-inline mt-1">
                            <input class="form-check-input" type="radio" name="status" id="deactive" value="0" {{ !$package->status ? 'checked' : '' }} required>
                            <label class="form-check-label" for="deactive">Deactive</label>
                        </div>
                    </div>
                    <a href="{{ route('packages.index') }}" class="btn btn-sm btn-warning"><i class="bi-arrow-left-square me-1"></i>Back</a>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi-check-square me-1"></i>Update</button>
                </form>
            </div>
        </div>
    </div>
@endsection
