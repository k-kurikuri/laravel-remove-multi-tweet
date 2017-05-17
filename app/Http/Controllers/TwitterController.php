<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterController extends Controller
{
    /**
     * 自身の投稿したタイムライン一覧を表示する
     *
     */
    public function index()
    {
        $twitter = app('twitter.api', [
            session('TWITTER_ACCESS_TOKEN'), session('TWITTER_ACCESS_TOKEN_SECRET')
        ]);

        // ユーザーのTimelineの一覧取得 (max : 200)
        $params = ['count' => 200,];
        if (request()->get('max_id')) {
            $params['max_id'] = request()->get('max_id');
        }

        $userTimeLines = $twitter->get('statuses/user_timeline', $params);

        return view('twitter.index', ['timeLines' => $userTimeLines]);
    }

    /**
     * リクエストされた、つぶやきID削除API呼び出す
     * 呼び出し後はindexアクションへとリダイレクトする
     *
     */
    public function remove()
    {
        $twitter = app('twitter.api', [
            session('TWITTER_ACCESS_TOKEN'), session('TWITTER_ACCESS_TOKEN_SECRET')
        ]);

        $tweetIds = request()->get('tweetIds');

        $maxId = 0;
        foreach ($tweetIds as $tweetId) {
            // id削除
            $twitter->post('statuses/destroy', ['id' => $tweetId,]);
            $maxId = $tweetId;
        }

         return redirect()->action('TwitterController@index', ['max_id' => $tweetId]);
    }
}