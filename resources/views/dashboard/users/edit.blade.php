@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <h2 class="mb-3">Update User</h2>
            <form action="/dashboard/users/{{ $user->username }}" method="POST">
                @method('put')
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ $user->name }}" required>
                    <label for="username">Name</label>
                    @error('name')
                    <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Contact" value="{{ $user->contact }}" required>
                    <label for="contact">Contact</label>
                    @error('contact')
                    <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ $user->email }}" required>
                    <label for="email">Email</label>
                    @error('email')
                    <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" value="{{ $user->username }}" required>
                    <label for="username">Username</label>
                    @error('username')
                    <div class="invalid-feedback mt-0 mb-3">{{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-control">
                    <h6>Access Type</h6>
                    @error('access_type')
                    <div class="invalid-feedback mt-0 mb-3">{{ $message }}
                    </div>
                    @enderror
                    <div class="form-check">
                        <input class="form-check-input @error('access_type') is-invalid @enderror" type="radio" name="access_type" id="kasir" value="0" required {{ $user->access_type === 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="kasir">Kasir</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input @error('access_type') is-invalid @enderror" type="radio" name="access_type" id="admin" value="1" required {{ $user->access_type === 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="admin">Admin</label>
                    </div>
                </div>
                <div class="form-control alert alert-danger mt-3">
                    <h6>Status</h5>
                        @error('active')
                        <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                        <div class="form-check">
                            <input class="form-check-input @error('active') is-invalid @enderror" type="radio" name="active" id="active" value="1" required {{ $user->active === 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('active') is-invalid @enderror" type="radio" name="active" id="deactive" value="0" required {{ $user->active === 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="deactive">Deactive</label>
                        </div>
                </div>
                <div class="form-control my-3">
                    <h6 class=" mb-1">Manage Password</h6>
                    <a href="/dashboard/users/{{ $user->username }}/reset">Reset</a> |
                    <a href="/dashboard/users/{{ $user->username }}/update">Update</a>
                </div>
                <div class="mt-3 d-flex justify-content-center col-sm-8">
                    <div class="my-3 d-flex justify-content-center">
                        <a href="/dashboard/users/{{ $user->username }}" class="btn btn-warning mt-2 btn-sm me-1" id="btn-cancel"><i class="bi-arrow-left-square me-1"></i>Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">
                            <i class="bi-check-square me-1"></i>Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection