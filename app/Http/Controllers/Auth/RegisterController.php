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
use App\Models\Applicant;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\Application\VerifyEmail;
use App\Notifications\Application\CompleteAP;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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

        return redirect()->route('apply.temp', compact('uuid'));
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
     * If everything is well, add the applicant to database temporarily.
     * Continue to form page to add other information.
     * 
     */
    protected function completeAuthenticationWithVATSIM(Request $request)
    {
        $resourceOwner = $request->session()->get('resourceOwner');
        $token = $request->session()->get('accessToken');
        $uuid = $request->session()->get('uuid');

        $request->session()->flush();

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

        if ($resourceOwner->data->oauth->token_valid === "true") { 
            
            // User has given us permanent access to data.

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
     * Start the manual application process.
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

        $when = now()->addSeconds(15);

        $applicant->notify((new VerifyEmail($applicant, $verifyUrl))->delay($when));

        return redirect()->route('apply.verify.manual', ['uuid' => $applicant->uuid]);
    }

    /**
     * Resend the applicant a verfication email.
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
            'email_verified_at' => now()
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

        if ($applicant->status == 'C') {
            return redirect()->route('apply.complete')->with('uuid', $applicant->uuid);
        }

        if ($applicant->email_verified_at == null) {
            return redirect()->route('apply.verify.manual', ['uuid' => $uuid]);
        }

        return view('apply.form', compact('applicant'));
    }

    /**
     * Complete the application.
     * 
     */
    protected function finalizeApplication(Request $request)
    {
        if (!Str::isUuid(request('uuid'))) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        $applicant = Applicant::where('uuid', request('uuid'))->first();

        if ($applicant == null) {
            return view('layouts.status')->with('status', 'Invalid UUID. Code #AP5' . rand(60, 69) . '.');
        }

        if ($applicant->vatsim != null) {
            $request->validate([
                'dob' => 'required|date|date_format:Y-m-d'
            ]);

            $applicant->fill([
                'dob' => request('dob'),
                'status' => 'C'
            ])->save();
        } else {
            $request->validate([
                'fname' => 'required',
                'lname' => 'required',
                'dob' => 'required|date|date_format:Y-m-d',
                'country' => 'required|max:2'
            ]);

            $applicant->fill([
                'fname' => request('fname'),
                'lname' => request('lname'),
                'dob' => request('dob'),
                'country' => request('country'),
                'status' => 'C',
                'verification_token' => null
            ])->save();
        }

        $when = now()->addSeconds(90);

        $applicant->notify((new CompleteAP($applicant))->delay($when));

        return redirect()->route('apply.complete')->with('uuid', $applicant->uuid);
    }

    /**
     * Complete the application.
     * 
     */
    public function completeApplication(Request $request)
    {
        // Set applicant UUID.
        $uuid = $request->session()->get('uuid');

        if (!Str::isUuid($uuid)) {
            return view('layouts.status')->with('status', 'Invalid Session. Code #AP5' . rand(10, 19) . '.');
        }

        $applicant = Applicant::where('uuid', $uuid)->first();

        if ($applicant == null) {
            return view('layouts.status')->with('status', 'Invalid Session. Code #AP5' . rand(10, 19) . '.');
        }

        return view('apply.complete', compact('uuid'));
    }
}
