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

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the user profile & update form.
     *
     */
    public function index() 
    {
        return view('main.user.profile');
    }

    /**
     * Show the user profile & update form.
     *
     */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
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

        return redirect('/profile')->with('success', 'Your profile has been successfully updated!');
    }
}
