@extends('dashboard.layouts.main')

@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h2>Add User</h2>
                <form action="{{ route('users.store') }}" method="post">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        <label for="username">Name</label>
                        @error('name')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control @error('contact') is-invalid @enderror" id="contact" name="contact" placeholder="Contact" value="{{ old('name') }}" required>
                        <label for="contact">Contact</label>
                        @error('contact')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Email" value="{{ old('name') }}" required>
                        <label for="username">Email</label>
                        @error('email')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-control">
                        <h6>Access Type</h6>

                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('name') is-invalid @enderror" type="radio" name="access_type" id="kasir" value="0" required>
                            <label class="form-check-label" for="kasir">Kasir</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input @error('name') is-invalid @enderror" type="radio" name="access_type" id="admin" value="1" required>
                            <label class="form-check-label" for="admin">Admin</label>
                        </div>

                        @error('active')
                            <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="reset" class="btn btn-outline-secondary mx-2">Reset</button>
                        <button type="submit" class="btn btn-outline-primary mx-2">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
