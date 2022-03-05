<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Use Facades Required Additionally
 *
 */
use League\OAuth2\Client\Token\AccessToken;
use App\Http\Controllers\Auth\VATSIM\OAuthController;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'fname',
        'lname',
        'avatar',
        'bio',
        'rwp',
        'email',
        'password',
        'dob',
        'country',
        'hub',
        'status',
        'vatsim',
        'access_token',
        'refresh_token',
        'token_expires',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'access_token',
        'refresh_token',
        'token_expires',
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to casts.
     *
     * @var array
     */
    protected $casts = [
        'dob',
    ];

    /**
     * When doing $user->token, return a valid access token or null if none exists.
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

    /**
     * Return Staff Notifications
     *
     */
    public function staff_notams()
    {
        return DB::table('broadcasts')->where('for', 'S')->latest()->limit(5)->get();
    }

    /**
     * Return Pilot Notifications
     *
     */
    public function pilot_notams()
    {
        return DB::table('broadcasts')->where('for', 'P')->latest()->limit(5)->get();
    }
}
