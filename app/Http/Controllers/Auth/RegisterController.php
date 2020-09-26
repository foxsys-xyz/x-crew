<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/*

* Use Facades Required Additionally

*/
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\OAuth2\Client\Token;
use App\Http\Controllers\Auth\VATSIM\OAuthController;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use App\Applicant;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

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
     * Override the default registration route. 
     * Redirect user to the temporary application page.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $uuid = (string) Str::uuid();

        return redirect(route('apply', compact('uuid')));
    }

    /**
     * Show the temporary application form.
     *
     * @return \Illuminate\View\View
     */
    public function showTemporaryForm($uuid)
    {
        if (!Str::isUuid($uuid)) {

            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        return view('apply.temp', compact('uuid'));
    }

    /**
     * Log In with VATSIM if auth code not found.
     * Go ahead and add the applicant to the database if auth code is in session.
     *
     */
    public function applyWithVATSIM(Request $request)
    {
        if (! $request->has('code') || ! $request->has('state')) { // User has clicked "login", redirect to Connect
            $authorizationUrl = $this->provider->getAuthorizationUrl(); // Generates state
            $request->session()->put('vatsimauthstate', $this->provider->getState());
            $request->session()->put('uuid', request('uuid'));
	    	return redirect()->away($authorizationUrl);
        }
		else if ($request->input('state') !== session()->pull('vatsimauthstate')) { // State mismatch, error
            return view('layouts.status')->with('status', 'Something\'s Wrong. Code #AP5' . rand(40, 49) . '.');
        }
		else { // Callback (user has just logged in Connect)
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

		// Check if user has granted us the data we need
        if (
            ! isset($resourceOwner->data) ||
	        ! isset($resourceOwner->data->cid) ||
            $resourceOwner->data->oauth->token_valid !== "true"
        ) {
            return view('layouts.status')->with('status', 'No Permissions. Code #AP5' . rand(40, 49) . '.');
        }

        // Set applicant UUID.
        $uuid = $request->session()->get('uuid');

        return $this->completeAuthenticationWithVATSIM($resourceOwner, $accessToken, $uuid);
    }

    /**
     * If everything is well, add the applicant to database temporarily.
     * Continue to form page to add other information.
     * 
     */
    protected function completeAuthenticationWithVATSIM($resourceOwner, $token, $uuid)
    {
        $applicant = Applicant::firstOrNew(
            [
                'email' => $resourceOwner->data->personal->email
            ],
            [
                'uuid' => $uuid,
                'fname' => $resourceOwner->data->personal->name_first,
                'lname' => $resourceOwner->data->personal->name_last,
                'country' => $resourceOwner->data->personal->country->id,
                'vatsim' => $resourceOwner->data->cid
            ]
        );

        if ($resourceOwner->data->oauth->token_valid === "true") { // User has given us permanent access to data
            $applicant->access_token = $token->getToken();
            $applicant->refresh_token = $token->getRefreshToken();
            $applicant->token_expires = $token->getExpires();
        }

        $applicant->save();

        // Update applicant's UUID to resolve conflicts if already registered or created.
        $uuid = $applicant->uuid;

        return redirect()->route('apply.form', ['uuid' => $uuid]);
    }

    /**
     * Show the application form for further addition of information.
     * 
     */
    public function showApplicationForm($uuid)
    {
        if (!Str::isUuid($uuid)) {

            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        $applicant = Applicant::where('uuid', $uuid)->first();

        if ($applicant == null) {

            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        return view('apply.form', compact('applicant'));
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
