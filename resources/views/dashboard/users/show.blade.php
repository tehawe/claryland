@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">

                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div id="data-user" class="p-2 my-3 border rounded">
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
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm me-1"><i class="me-1 bi-arrow-left-square"></i>Back</a>
                        <a href="{{ route('users.edit', $user->username) }}" class="btn btn-warning btn-sm me-1"><i class="me-1 bi-pencil-square"></i>Edit</a>
                    </div>

                </div>

                <div class="form-control my-3" id="user-manage-password">
                    <h6 class="border-bottom my-1 pb-2">Manage Password</h6>

                    @if (session()->has('success_password'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success_password') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('errorUpdate'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('errorUpdate') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <button class="btn-sm btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modal-reset">Reset</button>
                    <button class="btn-sm btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-update">Update</button>


                    {{-- modal reset --}}
                    <div class="modal fade" id="modal-reset" tabindex="-1" aria-labelledby="modalResetLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalResetLabel">Reset Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.password.reset', $user->username) }}" method="POST">
                                        @method('patch')
                                        @csrf
                                        <p>your email and then check your email</p>
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                            <label for="email">Email</label>
                                            @error('email')
                                                <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mt-3 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-outline-danger mx-2">Reset Password</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- modal update --}}
                    <div class="modal fade" id="modal-update" tabindex="-1" aria-labelledby="modalUpdateLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalUpdateLabel">Update Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('users.password.update', $user->username) }}" method="POST" class="text-center">
                                        @method('patch')
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="New Password" required minlength="6">
                                            <label for="new_password">New Password</label>
                                            @error('new_password')
                                                <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required onkeyup="checkInput()">
                                            <label for="confirm_password">Confirm Password</label>
                                            @error('confirm_password')
                                                <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                                            @enderror
                                            <div class="invalid-feedback mt-0 mb-3" id="info-error"></div>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old Password" required>
                                            <label for="old_password">Old Password</label>
                                            @error('old_password')
                                                <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                                            @enderror
                                        </div>


                                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                                            <i class="bi-check-square me-1"></i>Update Password
                                        </button>
                                    </form>

                                    <script>
                                        const newPassword = document.getElementById('new_password');
                                        const confPassword = document.getElementById('confirm_password');

                                        function checkInput() {
                                            if (confPassword.value != newPassword.value) {
                                                confPassword.setCustomValidity('Passwords is not match');
                                            } else {
                                                confPassword.setCustomValidity('');
                                            }
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
@endsection
