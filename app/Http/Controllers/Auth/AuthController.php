<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * twitter OAuth Callback redirect
     *
     * @return Response
     */
    public function socialCallback()
    {
        $socialUser = Socialite::driver('twitter')->user();

        return view('twitter.index', ['user' => $socialUser]);
    }
}
