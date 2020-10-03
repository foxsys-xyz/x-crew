<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**
 * Use Facades Required Additionally
 *
 */

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use League\OAuth2\Client\Token;
use App\Http\Controllers\Auth\VATSIM\OAuthController;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use App\Models\Applicant;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\Application\VerifyEmail;

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
            if (!Str::isUuid(request('uuid'))) {
                return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
            }
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

        // Since applicant is possesing a verified email with VATSIM, verify it.
        if ($applicant->email_verified_at == null) {
            $applicant->email_verified_at = now();
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
    protected function applyManual(Request $request)
    {
        if (!Str::isUuid(request('uuid'))) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        $request->validate([
            'email' => 'required|email'
        ]);

        $applicant = Applicant::firstOrCreate(
            [
                'email' => request('email')
            ],
            [
                'uuid' => request('uuid')
            ]
        );

        if ($applicant->email_verified_at == null && $applicant->verification_token == null) {
            return $this->sendVerificationEmail($applicant);
        } elseif ($applicant->email_verified_at == null && $applicant->verification_token != null) {
            return redirect()->route('apply.verify.manual', ['uuid' => $applicant->uuid]);
        }

        // Update applicant's UUID to resolve conflicts if already registered or created.
        $uuid = $applicant->uuid;

        return redirect()->route('apply.form', ['uuid' => $uuid]);
    }

    /**
     * Send the applicant a verification email.
     * 
     */
    protected function sendVerificationEmail($applicant)
    {
        $verifyToken = sha1(time());

        $applicant->fill([
            'verification_token' => $verifyToken
        ])->save();

        $verifyToken = Crypt::encryptString($applicant->verification_token);

        $verifyUrl = route('apply.verify.email.manual', ['verifyToken' => $verifyToken]);

        $when = now()->addSeconds(30);

        $applicant->notify((new VerifyEmail($applicant, $verifyUrl))->delay($when));

        return redirect()->route('apply.verify.manual', ['uuid' => $applicant->uuid]);
    }

    /**
     * Show the verification page [awaiting user to verify email].
     * 
     */
    protected function resendVerificationEmail(Request $request)
    {
        if (!Str::isUuid(request('uuid'))) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        $applicant = Applicant::where('uuid', request('uuid'))->first();

        if ($applicant == null) {
            return view('layouts.status')->with('status', 'Invalid/Expired Token. Code #AP9' . rand(40, 49) . '.');
        }

        if ($applicant->email_verified_at != null) {
            return redirect()->route('apply.form', ['uuid' => $applicant->uuid]);
        }

        return $this->sendVerificationEmail($applicant);
    }

    /**
     * Show the verification page [awaiting user to verify email].
     * 
     */
    public function verifyManual($uuid)
    {
        if (!Str::isUuid($uuid)) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        $applicant = Applicant::where('uuid', $uuid)->first();

        if ($applicant == null) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        if ($applicant->email_verified_at != null) {
            return redirect()->route('apply.form', ['uuid' => $applicant->uuid]);
        }

        return view('apply.verify', compact('applicant'));
    }

    /**
     * Function for verifying the email and token.
     * 
     */
    protected function verifyEmailToken($verifyToken)
    {
        $decryptToken = Crypt::decryptString($verifyToken);

        $applicant = Applicant::where('verification_token', $decryptToken)->first();

        if ($applicant == null) {
            return view('layouts.status')->with('status', 'Invalid/Expired Token. Code #AP9' . rand(40, 49) . '.');
        }

        $applicant->fill([
            'email_verified_at' => now(),
            'verification_token' => null
        ])->save();

        return redirect()->route('apply.form', ['uuid' => $applicant->uuid]);
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

        if ($applicant->email_verified_at == null) {
            return redirect()->route('apply.verify.manual', ['uuid' => $uuid]);
        }

        return view('apply.form', compact('applicant'));
    }
}
