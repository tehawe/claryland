@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h2>Add New Category</h2>
                <form action="/dashboard/categories" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" required>
                        <label for="name">Category Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" id="description" name="description" placeholder="Descriptions" rows="3"></textarea>
                        <label for="description">Descriptions</label>
                    </div>
                    <div class="my-2 d-flex justify-content-center">
                        <button type="reset" class="btn btn-secondary btn-sm me-1"><i class="bi-x-square me-1"></i>Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi-check-square me-1"></i>Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
