@extends('dashboard.layouts.main')

@section('container')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <form action="/dashboard/users/password/{{ $user->username }}" method="POST">
                @method('patch')
                @csrf
                <div class="form-control mt-3" id="update-password">
                    <h6 class="mb-2">Update Password</h6>
                    <div class="form-floating col-sm-8 mb-3">
                        <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" placeholder="New Password">
                        <label for="new_password">New Password</label>
                        @error('new_password')
                        <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-floating col-sm-8 mb-3">
                        <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" name="confirm_password" placeholder="Confirm Password" onchange="checkInput(this)">
                        <label for="confirm_password">Confirm Password</label>
                        @error('confirm_password')
                        <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                        <div class="invalid-feedback mt-0 mb-3" id="info-error"></div>
                    </div>
                    <div class="form-floating col-sm-8 mb-3">
                        <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Old Password">
                        <label for="old_password">Old Password</label>
                        @error('old_password')
                        <div class="invalid-feedback mt-0 mb-3">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-control d-flex justify-center">
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
<script>
    const newPassword = document.getElementById('new_password');
    const confPassword = document.getElementById('confirm_password');

    function checkInput(confPassword) {
        if (confPassword.value != newPassword.value) {
            confPassword.setCustomValidity('Passwords is not match');
        } else {
            confPassword.setCustomValidity('');
        }
    }
</script>
@endsection