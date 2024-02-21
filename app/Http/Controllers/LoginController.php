<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            return redirect()->intended('dashboard/home');
        }
        return view('login', ['title' => 'Login']);
    }

    /**
     * Login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (auth()->user()->access_type === 1) {
                return redirect()->intended('dashboard/home');
            } else {
                return redirect()->intended('dashboard/cashier');
            }
        }
        return back()->with('loginError', 'Login Failed!');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verifiedResetPassword(Request $request)
    {
        $user = User::where('email', $request->email)->ffirst();
        if ($user->password === $request->new_password)
            return redirect()->route('login')->with('success', 'Your password has been reset successfully');
    }
}
