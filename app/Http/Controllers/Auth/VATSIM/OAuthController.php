<?php

namespace App\Http\Controllers\Auth\VATSIM;

use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
 
use League\OAuth2\Client\Token;
use Illuminate\Support\Facades\Auth;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

class OAuthController extends GenericProvider
{
    /**
     * @var GenericProvider
     */
    private $provider;

    /**
     * Initializes the provider variable.
     */
    public function __construct()
    {
        parent::__construct([
            'clientId'                => config('vatsim.id'),    // The client ID assigned to you by the provider
            'clientSecret'            => config('vatsim.secret'),   // The client password assigned to you by the provider
            'redirectUri'             => route('apply.check.with.vatsim'),
            'urlAuthorize'            => config('vatsim.base').'/oauth/authorize',
            'urlAccessToken'          => config('vatsim.base').'/oauth/token',
            'urlResourceOwnerDetails' => config('vatsim.base').'/api/user',
            'scopes'                  => config('vatsim.scopes'),
            'scopeSeparator'          => ' '
        ]);
    }

    /**
     * Gets an (updated) user token
     * @param Token $token
     * @return Token
     * @return null
     */
    public static function updateToken($token)
    {
        $controller = new OAuthController;
        try {
            return $controller->getAccessToken('refresh_token', [
                'refresh_token' => $token->getRefreshToken()
            ]);
        } catch (IdentityProviderException $e) {
            return null;
        }
    }
}
