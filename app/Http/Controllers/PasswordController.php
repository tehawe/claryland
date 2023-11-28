<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(User $user)
    {
        return view('dashboard.users.password.reset', [
            'title' => 'Password Manager',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        if (Hash::make($request->confirm_password) == $user->password)
            $new_password = Hash::make($request->confirm_password);
        dd($new_password);
    }
}
