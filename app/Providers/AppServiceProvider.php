<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Abraham\TwitterOAuth\TwitterOAuth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // TODO: 引数に関してはいいやり方見つけ次第
        $this->app->bind('twitter.api', function ($app, $params = []) {
            $consumerKey = env('TWITTER_ID');
            $secretToken = env('TWITTER_SECRET');
            $accessToken = isset($params[0]) ? $params[0] : null;
            $accessTokenSecret = isset($params[1]) ? $params[1] : null;

            return new TwitterOAuth ($consumerKey, $secretToken, $accessToken, $accessTokenSecret);
        });
    }
}
