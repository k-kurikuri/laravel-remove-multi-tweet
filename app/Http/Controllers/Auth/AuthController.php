<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * twitter OAuth authenticate
     * @return mixed
     */
    public function redirectToSocial()
    {
        $twitter = app('twitter.api');
        $response = $twitter->oauth('oauth/request_token', ['oauth_callback' => env('TWITTER_CALLBACK')]);

        session(['TWITTER_ACCESS_TOKEN_SECRET' => $response['oauth_token_secret']]);

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * twitter OAuth Callback redirect
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function socialCallback()
    {
        $oAuthToken = request()->get('oauth_token');
        $oAuthVerifier = request()->get('oauth_verifier');

        $accessToken = $oAuthToken;
        $accessTokenSecret = session('TWITTER_ACCESS_TOKEN_SECRET');

        $twitter = app('twitter.api', [$accessToken, $accessTokenSecret]);
		$response = $twitter->oauth("oauth/access_token", ['oauth_verifier' => $oAuthVerifier]);

        session(['TWITTER_ACCESS_TOKEN' => $response['oauth_token']]);
        session(['TWITTER_ACCESS_TOKEN_SECRET' => $response['oauth_token_secret']]);

        return redirect('twitter');
    }
}
