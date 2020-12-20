<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::withTrashed()->get();

        return view('home.users.list', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(UserRequest $request)
    {
        $commit = User::create([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        if ($commit) {
            return redirect()->route('users')->with('success', __('Successfully created'));
        } else {
            return redirect()->route('users')->with('error', __('Failed to create'));
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        if (Auth::user()->id == $id) {
            return;
        }

        $user = User::find($id);

        if ($user->delete()) {
            return [
                'status' => true,
                'message' => __('Successfully deleted'),
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to delete'),
            ];
        }
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (Auth::user()->id == $id) {
            return;
        }

        $user = User::onlyTrashed()->where('id', $id)->first();

        if ($user->restore()) {
            return [
                'status' => true,
                'message' => __('Successfully restored'),
            ];
        } else {
            return [
                'status' => false,
                'message' => __('Failed to restore'),
            ];
        }
    }
}
