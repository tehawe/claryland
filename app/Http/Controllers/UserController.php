<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index', [
            'title' => 'Users',
            'users' => User::orderBy('access_type', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.users.create', [
            'title' => 'Users',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'max:255'],
            'contact' => ['required', 'unique:users'],
            'email' => ['required', 'email:dns', 'unique:users'],
            'access_type' => ['required'],
        ]);
        $username = Str::of($user['email'])->explode('@');
        $user['username'] = $username[0];
        $user['password'] = bcrypt('password');

        User::create($user);
        $request->session()->flash('success', 'Add user success.');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('dashboard.users.show', [
            'title' => 'User',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', [
            'title' => 'User',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [];
        // Data User
        if ($request->name != $user->name) {
            $rules['name'] = ['required', 'max:255'];
        }
        if ($request->email != $user->email) {
            $rules['email'] = ['required', 'unique:users'];
        }
        if ($request->contact != $user->contact) {
            $rules['contact'] = ['required', 'unique:users'];
        }
        if ($request->username != $user->username) {
            $rules['username'] = ['required', 'unique:users'];
        }

        // Access Type
        if ($request->access_type != $user->access_type) {
            $rules['access_type'] = ['required'];
        }

        // Status Active
        if ($request->active != $user->active) {
            $rules['active'] = ['required'];
        }

        $dataNew = $request->validate($rules);

        User::where('username', $user->username)->update($dataNew);
        $request->session()->flash('success', 'Update data user success.');
        return redirect()->route('users.show', $request->username);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        //
    }
}
