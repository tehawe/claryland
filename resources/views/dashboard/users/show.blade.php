@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div id="data-user">
                    <h4>{{ $user->name }}</h4>
                    <table class="table">
                        <tbody class="table-group-divider">
                            <tr>
                                <td class="text-secondary">Contact</td>
                                <td>{{ $user->contact }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Email</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Username</td>
                                <td>{{ $user->username }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Access Type</td>
                                <td>{{ $user->access_type == 0 ? 'Kasir' : 'Admin' }}</td>
                            </tr>
                            <tr>
                                <td class="text-secondary">Status</td>
                                <td>{{ $user->active == 0 ? 'Deactive' : 'Active' }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="d-flex justify-content-center">
                                        <a href="/dashboard/users" class="btn btn-info btn-sm me-1"><i class="me-1 bi-arrow-left-square"></i>Back</a>
                                        <a href="/dashboard/users/{{ $user->username }}/edit" class="btn btn-info btn-sm me-1"><i class="me-1 bi-pencil-square"></i>Edit</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
