@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="users">
        <h1>Users</h1>
        <hr color="border-primary" />
        <a href="/dashboard/users/create" class="btn btn-primary mb-3">
            <i class="myicon bi-person-fill-add"></i>Add User
        </a>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div id="data-user">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Access Type</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->access_type == 1 ? 'Admin' : 'Kasir' }}</td>
                            <td>{{ $user->active == 1 ? 'Active' : 'Deactive' }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="/dashboard/users/{{ $user->username }}" class="btn btn-info btn-sm me-1">
                                        <i class="bi-person-square me-1"></i>Show
                                    </a>
                                    <a href=" /dashboard/users/{{ $user->username }}/edit" class="btn btn-warning btn-sm me-1">
                                        <i class="bi-pencil-square me-1"></i>Edit
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
