<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Use Facades Required Additionally
 *
 */

use Illuminate\Notifications\Notifiable;
use League\OAuth2\Client\Token\AccessToken;
use App\Http\Controllers\Auth\VATSIM\OAuthController;

class Applicant extends Model
{
    use Notifiable;

    /**
     * Your user model will need to contain at least the following attributes.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'fname',
        'lname',
        'email',
        'email_verified_at',
        'verification_token',
        'dob',
        'country',
        'vatsim',
        'access_token',
        'refresh_token',
        'token_expires',
        'status'
    ];

    /**
     * At least the following attributes should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'verification_token',
        'access_token',
        'refresh_token',
        'token_expires',
    ];

    /**
     * When doing $user->token, return a valid access token or null if none exists
     * 
     * @return \League\OAuth2\Client\Token\AccessToken 
     * @return null
     */
    public function getTokenAttribute()
    {
        if ($this->access_token === null) return null;

        else {
            $token = new AccessToken([
                'access_token' => $this->access_token,
                'refresh_token' => $this->refresh_token,
                'expires' => $this->token_expires,
            ]);

            if ($token->hasExpired()) {
                $token = OAuthController::updateToken($token);
            }

            // Can't put it inside the "if token expired"; $this is null there
            // but anyway Laravel will only update if any changes have been made.

            $this->update([
                'access_token' => ($token) ? $token->getToken() : null,
                'refresh_token' => ($token) ? $token->getRefreshToken() : null,
                'token_expires' => ($token) ? $token->getExpires() : null,
            ]);

            return $token;
        }
    }
}
