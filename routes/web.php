<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/twitter', 'Auth\AuthController@redirectToSocial');
Route::get('/auth/twitter/callback', 'Auth\AuthController@socialCallback');

Route::get('/twitter', 'TwitterController@index');
Route::post('/twitter/remove', 'TwitterController@remove');