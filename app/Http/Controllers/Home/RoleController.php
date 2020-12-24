<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('home.roles.list', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $commit = Role::create([
            'name' => $request->input('name'),
        ]);

        if ($commit) {
            return redirect()->route('roles')->with('success', __('Successfully created'));
        } else {
            return redirect()->route('roles')->with('error', __('Failed to create'));
        }
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
        $role = Role::findOrFail($id);

        return view('home.roles.edit', [
            'role' => $role,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        $commit = $role->update([
            'name' => $request->input('name'),
        ]);

        if ($commit) {
            return redirect()->route('roles')->with('success', __('Successfully updated'));
        } else {
            return redirect()->route('roles')->with('error', __('Failed to update'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $role = Role::findOrFail($id);

        if ($role->users->count()) {
            return redirect()->route('roles')->with('error', __('Failed to delete'));
        }

        $commit = $role->delete();
        
        if ($commit) {
            return redirect()->route('roles')->with('success', __('Successfully deleted'));
        } else {
            return redirect()->route('roles')->with('error', __('Failed to delete'));
        }
    }
}
