<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{    
    /**
     * Show the user profile & update form.
     *
     */
    public function index() 
    {
        return view('main.user.profile');
    }

    /**
     * Update user profile.
     *
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'email' => 'email|required',
            'avatar' => 'image',
        ]);

        $email = request('email');
        $bio = request('bio');

        if ($request->hasFile('avatar')) {
            
            $file = $request->file('avatar');
            $path = $file->hashName('public/avatars');

            $image = Image::make($file)->fit(256);

            Storage::put($path, (string) $image->encode());
            $url = Storage::url($path);

            User::find(Auth::user()->id)->update([
                'avatar' => $url,
            ]);
        }

        User::find(Auth::user()->id)->update([
            'email' => $email,
            'bio' => $bio,
        ]);

        return redirect('/profile')->with('success', 'your profile has been updated successfully.');
    }

    /**
     * Update user password.
     *
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'oldpass' => 'required',
            'newpass' => 'required|confirmed',
            'newpass_confirmation' => 'required',
        ]);

        $user = User::find(Auth::user()->id);

        if (! Hash::check(request('oldpass'), $user->password)) {
            return back()->with('error', 'hmm... the old password seems incorrect.');
        }

        $user->update([
            'password' => Hash::make(request('newpass')),
        ]);

        return redirect('/profile')->with('success', 'your password has been updated successfully.');
    }
}
