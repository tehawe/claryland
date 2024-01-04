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
                <form action="{{ route('packages.store') }}" method="POST" class="text-center form-control-sm w-50">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Package Name" value="{{ @old('name') }}" required>
                        <label for="name">Package Name</label>
                    </div>
                    <div class="form-floating mb-3 w-25">
                        <input type="number" class="form-control" name="price" id="price" placeholder="Package Price (Rp)" value="{{ @old('price') }}" min="0" minlength="4" required>
                        <label for="price">Price</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="Leave a description here" name="description" id="description" style="height: 100px">{{ @old('description') }}</textarea>
                        <label for="description">Description</label>
                    </div>
                    <div class="row">
                        <div class="col form-floating mb-3">
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ @old('start_date') }}" placeholder="Start Date">
                            <label for="start_date" class="ms-2">Start Date</label>
                        </div>
                        <div class="col form-floating mb-3">
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ @old('end_date') }}" placeholder="End Date">
                            <label for="end_date" class="ms-2">End Date</label>
                        </div>
                    </div>
                    <div class="bg-info text-light fs-6 p-1 rounded mb-4">Default status is Active, you can change the status by Edit menu.</div>
                    <button type="reset" class="btn btn-sm btn-warning"><i class="bi-arrow-left-square me-1"></i>Reset</button>
                    <button type="submit" class="btn btn-sm btn-primary"><i class="bi-check-square me-1"></i>Create</button>
                </form>
            </div>
        </div>
    </div>
@endsection
