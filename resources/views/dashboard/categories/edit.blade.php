@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h2>Update Category</h2>
                <form action="/dashboard/categories/{{ $categories->id }}" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" id="name" name="name" placeholder="Category Name" value="{{ $categories->name }}" required>
                        <label for="name">Category Name</label>
                        @error('name')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" placeholder="Descriptions" rows="3">{{ $categories->description }}</textarea>
                        <label for="description">Descriptions</label>
                        @error('description')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="my-2 d-flex justify-content-center">
                        <button type="reset" class="btn btn-secondary btn-sm me-1"><i class="bi-x-square me-1"></i>Reset</button>
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi-check-square me-1"></i>Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
