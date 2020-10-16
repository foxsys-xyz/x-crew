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
use App\Http\Controllers\Auth\VATSIM\Login\OAuthController;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

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

    protected $provider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->provider = new OAuthController;
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
     * Redirect to VATSIM Connect if auth code not found.
     * Verify if the user exists in the database if auth code is in session.
     *
     */
    public function loginWithVATSIM(Request $request)
    {
        if (! $request->has('code') || ! $request->has('state')) { // User has clicked "login", redirect to Connect
            $authorizationUrl = $this->provider->getAuthorizationUrl(); // Generates state
            $request->session()->put('vatsimauthstate', $this->provider->getState());
	    	return redirect()->away($authorizationUrl);
        }
		else if ($request->input('state') !== session()->pull('vatsimauthstate')) { // State mismatch, error
            return redirect('/')->withError("Something went wrong, please try again.");
        }
		else { // Callback (user has just logged in Connect)
            return $this->verifyLogin($request);
        }
    }

    protected function verifyLogin(Request $request)
    {
        try {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $request->input('code')
            ]);
        } catch (IdentityProviderException $e) {
            return redirect('/')->withError("Something went wrong, please try again later.");
        }
        $resourceOwner = json_decode(json_encode($this->provider->getResourceOwner($accessToken)->toArray()));

		// Check if user has granted us the data we need
        if (
            ! isset($resourceOwner->data) ||
	        ! isset($resourceOwner->data->cid) ||
            $resourceOwner->data->oauth->token_valid !== "true"
        ) {
            return redirect('/')->withError("We need you to grant us all marked permissions");
        }

        $this->completeLogin($resourceOwner, $accessToken);
        return redirect()->intended('/')->withSuccess('Login Successful');
    }

    protected function completeLogin($resourceOwner, $token)
    {
        $account = User::where('vatsim', $resourceOwner->data->cid)->first();

        if ($resourceOwner->data->oauth->token_valid === "true") { // User has given us permanent access to data
            $account->access_token = $token->getToken();
            $account->refresh_token = $token->getRefreshToken();
            $account->token_expires = $token->getExpires();
        }

        $account->save();
        auth()->login($account, true);
		
        return $account;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
}
