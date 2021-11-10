<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Spatie\Permission\Models\Role;

class RequestsController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth', 'permission:manage']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasRole('Admin')) {
            $users = User::where('status', false)->where('department_id', auth()->user()->department_id)->get();
            return view('pages.requests', compact('users'));
        } elseif (auth()->user()->hasRole('Root')) {
            $users = User::where('status', false)->get();
            return view('pages.requests', compact('users'));
        }

        return redirect('/')->with('failure', 'You do not have the permission to acces to this page');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $role = $request->input('role');
        $user = User::findOrFail($id);
        $user->status = true;
        $user->save();

        if ($role == 'user')
            $r = Role::where('name', 'User')->first();
        else if ($role == 'admin')
            $r = Role::where('name', 'Admin')->first();

        $user->assignRole($r);

        \Log::addToLog('User Accepted');

        return redirect('/requests')->with('success', 'User Accepted');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}