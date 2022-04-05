<?php

namespace App\Http\Controllers\Auth\VATSIM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use League\OAuth2\Client\Token;
use App\Http\Controllers\Auth\VATSIM\OAuthController;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use Illuminate\Support\Str;

class ConnectController extends Controller
{
    protected $provider;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->provider = new OAuthController;
    }

    /**
     * Redirect to VATSIM Connect if auth code not found.
     * Go ahead and add the applicant to the database if auth code is in session.
     *
     */
    public function connectWithVATSIM(Request $request)
    {
        if (! $request->has('code') || ! $request->has('state')) {

            // When the request is being made through 'application' schema.
            
            if ($request->has('uuid')) {
                if (!Str::isUuid(request('uuid'))) {
                    return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
                }

                $request->session()->put('uuid', request('uuid'));
            }
            
            $authorizationUrl = $this->provider->getAuthorizationUrl(); 
            
            // Generates state

            $request->session()->put('vatsimauthstate', $this->provider->getState());
	    	return redirect()->away($authorizationUrl);
        }
		else if ($request->input('state') !== session()->pull('vatsimauthstate')) { 

            // State mismatch, error.

            return view('layouts.status')->with('status', 'Something\'s Wrong. Code #AP5' . rand(40, 49) . '.');
        }
		else { 
            
            // Callback (User has just logged in Connect).

            return $this->verifyAuthenticationWithVATSIM($request);
        }
    }

    /**
     * Verify if the auth code recieved from connect is valid.
     * 
     */
    protected function verifyAuthenticationWithVATSIM(Request $request)
    {
        try {
            $accessToken = $this->provider->getAccessToken('authorization_code', [
                'code' => $request->input('code')
            ]);
        } catch (IdentityProviderException $e) {
            return view('layouts.status')->with('status', 'Something\'s Wrong. Code #AP5' . rand(40, 49) . '.');
        }

        $resourceOwner = json_decode(json_encode($this->provider->getResourceOwner($accessToken)->toArray()));

		// Check if user has granted us the data we need.

        if (
            ! isset($resourceOwner->data) ||
	        ! isset($resourceOwner->data->cid) ||
            $resourceOwner->data->oauth->token_valid !== "true"
        ) {
            return view('layouts.status')->with('status', 'No Permissions. Code #AP5' . rand(40, 49) . '.');
        }

        // When the request is being made through 'application' schema.
            
        if ($request->session()->has('uuid')) {
            
            // Set applicant UUID in case of application.

            $uuid = $request->session()->get('uuid');

            $request->session()->flush();

            $request->session()->put('resourceOwner', $resourceOwner);
            $request->session()->put('accessToken', $accessToken);
            $request->session()->put('uuid', $uuid);

            return redirect()->route('apply.with.vatsim');
        }

        $request->session()->flush();

        $request->session()->put('resourceOwner', $resourceOwner);
        $request->session()->put('accessToken', $accessToken);

        return redirect()->route('login.with.vatsim');

        // return $this->completeAuthenticationWithVATSIM($resourceOwner, $accessToken, $uuid);
    }
}
