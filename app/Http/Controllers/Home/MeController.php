<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\MeRequest;
use App\Http\Requests\MePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\MediaFile;

class MeController extends HomeController
{
    const ALLOWED_EXT = ['png', 'jpg'];

    /**
     * Show the user info profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.me');
    }

    /**
     * Update User general info
     * 
     * @param App\Http\Requests\MeRequest $request
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function updateInfo(MeRequest $request)
    {
        $user = Auth::user();
        $commit = $user->update([
            'first_name' => $request->input('first_name'),
            'middle_name' => $request->input('middle_name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        if ($commit) {
            return redirect()->route('me')->with('success', __('Sucessfully updated'));
        } else {
            return redirect()->route('me')->with('error', __('Failed to update'));
        }
    }

    /**
     * Update User password
     * 
     * @param App\Http\Requests\MePasswordRequest $request
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(MePasswordRequest $request)
    {
        $user = Auth::user();
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        if (!Auth::attempt(['email' => Auth::user()->email, 'password' => $old_password])) {
            return redirect()->route('me')->with('error', __('Password mismatched'));
        }

        if ($new_password == $old_password) {
            return redirect()->route('me')->with('error', __('Password in use'));
        }

        $commit = $user->update([
            'password' => Hash::make($new_password),
        ]);

        if ($commit) {
            return redirect()->route('me')->with('success', __('Successfully updated'));
        } else {
            return redirect()->route('me')->with('error', __('Failed to update'));
        }
    }

    /**
     * Update User avatar
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $user_avatar = $user->avatar;
        $avatar = $request->file('avatar');
        
        if (!in_array($avatar->getClientOriginalExtension(), MediaFile::ALLOWED_IMG_EXT)) {
            return redirect()->route('me')->with('error', __('File type not allowed'));
        }

        $path = Storage::disk('public')->put(MediaFile::IMG_F, $avatar);
        $path = '/storage/' . $path;
        
        if ($user_avatar) {
            $old_path = str_replace('/storage/', '', $user_avatar->path);
            $user_avatar->update([
                'path' => $path,
            ]);
            Storage::disk('public')->delete($old_path);
        } else {
            MediaFile::create([
                'ownable_type' => User::class,
                'ownable_id' => $user->id,
                'media_type' => MediaFile::IMG_F,
                'path' => $path,
            ]);
        }

        return redirect()->route('me')->with('success', __('Successfully updated'));
    }

    /**
     * Update User lang and name format
     * 
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Contracts\Support\Renderable
     */
    public function updateLang(Request $request)
    {
        $user = Auth::user();
        $commit = $user->update([
            'is_first_name_first' => $request->input('is_first_name_first'),
            'lang' => $request->input('lang'),
        ]);

        if ($commit) {
            return redirect()->route('me')->with('success', __('Successfully updated'));
        } else {
            return redirect()->route('me')->with('error', __('Failed to update'));
        }
    }
}
