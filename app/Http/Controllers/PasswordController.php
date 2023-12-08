<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{

    public function reset(Request $request, User $user)
    {
        if ($request->email !== $user->email) { // if email not equal with existing email
            return back()->with('errorPassword', 'Reset password failed'); // return back with error info
        }
        User::where('email', $user->email)->update([
            'password' => Hash::make($user->email) // success, new password will generate by existing email using Hash
        ]);
        return redirect()->route('users.show', $user->username)->with('successPassword', 'Reset password success'); // return to users info
    }

    public function update(Request $request, User $user)
    {
        User::where('username', $user->username)->update([
            'password' => Hash::make($request->new_password),
        ]);
        return redirect()->route('users.show', $user->username)->with('successPassword', 'Update password success');
    }
}
