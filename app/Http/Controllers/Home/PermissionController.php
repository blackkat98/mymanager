<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();

        return view('home.permissions.list', [
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request)
    {
        $commit = Permission::create([
            'name' => $request->input('name'),
        ]);

        if ($commit) {
            return redirect()->route('permissions')->with('success', __('Successfully created'));
        } else {
            return redirect()->route('permissions')->with('error', __('Failed to create'));
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
        $permission = Permission::findOrFail($id);

        return view('home.permissions.edit', [
            'permission' => $permission,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $commit = $permission->update([
            'name' => $request->input('name'),
        ]);

        if ($commit) {
            return redirect()->route('permissions')->with('success', __('Successfully updated'));
        } else {
            return redirect()->route('permissions')->with('error', __('Failed to update'));
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
        $permission = Permission::findOrFail($id);

        if ($permission->roles->count()) {
            return redirect()->route('permissions')->with('error', __('Failed to delete'));
        }

        $commit = $permission->delete();
        
        if ($commit) {
            return redirect()->route('permissions')->with('success', __('Successfully deleted'));
        } else {
            return redirect()->route('permissions')->with('error', __('Failed to delete'));
        }
    }
}
