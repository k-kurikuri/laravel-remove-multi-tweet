<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abraham\TwitterOAuth\TwitterOAuth;
use Socialite;

class AuthController extends Controller
{
    /**
     * twitter OAuth authenticate
     *
     * @return Response
     */
    public function redirectToSocial()
    {
        $twitter = app('twitter.api');
        $response = $twitter->oauth('oauth/request_token', array('oauth_callback' => env('TWITTER_CALLBACK')));

        session(['TWITTER_ACCESS_TOKEN_SECRET' => $response['oauth_token_secret']]);

        return Socialite::driver('twitter')->redirect();
    }

    /**
     * twitter OAuth Callback redirect
     *
     * @return Response
     */
    public function socialCallback()
    {
        $outhToken = request()->get('oauth_token');
        $oAuthVerifier = request()->get('oauth_verifier');

        $accessToken = $outhToken;
        $accessTokenSecret = session('TWITTER_ACCESS_TOKEN_SECRET');

        $twitter = app('twitter.api', [$accessToken, $accessTokenSecret]);
		$response = $twitter->oauth("oauth/access_token", ['oauth_verifier' => $oAuthVerifier]);

        session(['TWITTER_ACCESS_TOKEN' => $response['oauth_token']]);
        session(['TWITTER_ACCESS_TOKEN_SECRET' => $response['oauth_token_secret']]);

        return redirect('twitter');
    }
}
