@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <h2>Add User</h2>
            <form action="/dashboard/users" method="post">
                @csrf
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    <label for="username">Name</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="contact" name="contact" placeholder="Contact" required>
                    <label for="contact">Contact</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    <label for="username">Email</label>
                </div>
                <h4>Access Type</h4>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="access_type" id="kasir" value="0" required>
                    <label class="form-check-label" for="kasir">Kasir</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="access_type" id="admin" value="1" required>
                    <label class="form-check-label" for="admin">Admin</label>
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