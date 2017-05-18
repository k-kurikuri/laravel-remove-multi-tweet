<?php

namespace App\Http\Controllers;

/**
 * Class TwitterController
 * @package App\Http\Controllers
 */
class TwitterController extends Controller
{
    /**
     * timeline limit count
     * @var int
     */
    const TIMELINE_LIMIT_COUNT = 200;

    /**
     * user tweet timeline list
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $twitter = app('twitter.api', [
            session('TWITTER_ACCESS_TOKEN'), session('TWITTER_ACCESS_TOKEN_SECRET')
        ]);

        // ユーザーのTimelineの一覧取得 (max : 200)
        $params = ['count' => self::TIMELINE_LIMIT_COUNT,];
        if (request()->get('max_id')) {
            $params['max_id'] = request()->get('max_id');
        }

        $userTimeLines = $twitter->get('statuses/user_timeline', $params);

        return view('twitter.index', ['timeLines' => $userTimeLines]);
    }

    /**
     * destroy tweets by tweetIds
     * @return \Illuminate\Http\RedirectResponse
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

         return redirect()->action('TwitterController@index', ['max_id' => $maxId]);
    }
}