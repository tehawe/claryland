<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.members.index', [
            'title' => 'Members',
            'members' => Member::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.members.create', [
            'title' => 'Members',
            'members' => Member::count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:2', 'max:255'],
            'contact' => ['required', 'unique:members'],
            'email' => ['email:dns', 'unique:users'],
        ]);
        Member::created($data);
        $request->session()->flash('success', 'New member has been added');
        return redirect('/dashboard/members');
    }

    /**
     * Display the specified resource.
     */
    public function show(Member $member)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Member $member)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
