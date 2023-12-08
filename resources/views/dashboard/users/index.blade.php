@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid" id="users">
        <h1>Users</h1>
        <hr color="border-primary" />
        <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">
            <i class="myicon bi-person-fill-add"></i>Add User
        </a>
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div id="data-user" class="p-2 my-3 border rounded">
            <table class="table table-sm" id="data-table">
                <thead class="table-info">
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Access Type</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->contact }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->access_type == 1 ? 'Admin' : 'Kasir' }}</td>
                            <td>{{ $user->active == 1 ? 'Active' : 'Deactive' }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('users.show', $user->username) }}" class="btn btn-info btn-sm me-1">
                                        <i class="bi-person-square me-1"></i>Show
                                    </a>
                                    <a href="{{ route('users.edit', $user->username) }}" class="btn btn-warning btn-sm me-1">
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
    <script>
        $(document).ready(function() {
            let table = new DataTable('#data-table');
        });
    </script>
@endsection
