<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * Use Facades Required Additionally
 *
 */

use Illuminate\Http\Request;
use League\OAuth2\Client\Token;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Replace email auth with username.
     *
     */
    public function username()
    {
        return 'username';
    }

    /**
     * If everything is well, check if the user exists & log the user in.
     * Continue to form page to add other information.
     * 
     */
    protected function completeAuthenticationWithVATSIM(Request $request)
    {
        $resourceOwner = $request->session()->get('resourceOwner');
        $token = $request->session()->get('accessToken');

        $request->session()->flush();

        $account = User::where('vatsim', $resourceOwner->data->cid)->first();

        if ($account == null) {
            
            return redirect()->route('login')->with('message', 'oops! the account is not registered.');
        }

        if ($resourceOwner->data->oauth->token_valid === "true") { 
            
            // User has given us permanent access to data.

            $account->access_token = $token->getToken();
            $account->refresh_token = $token->getRefreshToken();
            $account->token_expires = $token->getExpires();
        }

        $account->save();

        auth()->login($account, true);

        return redirect()->route('dashboard');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
