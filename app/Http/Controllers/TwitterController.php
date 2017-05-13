<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function index()
    {
        $twitter = app('twitter.api', [session('TWITTER_ACCESS_TOKEN'), session('TWITTER_ACCESS_TOKEN_SECRET')]);

		// Timelineの取得
		$timeLine = $twitter->get('statuses/home_timeline', ['count' => 5]);

		return ['timeLine' => $timeLine];
    }
}
