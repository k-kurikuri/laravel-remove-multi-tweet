<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    public function index()
    {
        $twitter = app('twitter.api', [
            session('TWITTER_ACCESS_TOKEN'), session('TWITTER_ACCESS_TOKEN_SECRET')
        ]);

		// ユーザーのTimelineの一覧取得
		$userTimeLines = $twitter->get('statuses/user_timeline', ['count' => 200,]);

		return view('twitter.index', ['timeLines' => $userTimeLines]);
    }

    /**
     * TODO: 削除APIをコール
     */
    public function remove()
    {

    }
}