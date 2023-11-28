@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <h2>Categories</h2>
                <hr />
                <a href="/dashboard/categories/create" class="btn btn-primary btn-sm my-3"><i class="bi-bookmark-plus me-1"></i>Add New Category</a>
                <div class="my-3 p-2 border rounded">
                    <table class="table table-sm table-hover" id="data-table">
                        <thead class="table-secondary">
                            <tr>
                                <th>Category Name</th>
                                <th>Product</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-end">{{ $category->products_count }}</td>
                                    <td class="d-flex justify-content-end">
                                        <a href="/dashboard/categories/{{ $category->id }}" class="btn btn-info btn-sm me-1"><i class="bi-file-earmark-check me-1"></i>Show</a>
                                        <a href="/dashboard/categories/{{ $category->id }}/edit" class="btn btn-warning btn-sm me-1"><i class="bi-pencil-square"></i>Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
