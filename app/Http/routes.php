<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
                       'auth'     => 'Auth\AuthController',
                       'password' => 'Auth\PasswordController',
                   ]);

/*
|--------------------------------------------------------------------------
| Public Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', [
    'as'   => 'home',
    'uses' => 'PagesController@home'
]);

/*
|--------------------------------------------------------------------------
| Authenticated User News Feed Page
|--------------------------------------------------------------------------
*/

Route::get('home', [
    'as'   => 'newsfeed',
    'uses' => 'NewsFeedController@index'
]);

Route::get('newsfeed', [
    'as'   => 'newsfeed',
    'uses' => 'NewsFeedController@index'
]);

Route::post('newsfeed', [
    'as'   => 'newsfeed',
    'uses' => 'NewsFeedController@post_status'
]);

/*
|--------------------------------------------------------------------------
| Authenticated User Profile Page
|--------------------------------------------------------------------------
*/

Route::get('profile', [
    'as'   => 'profile',
    'uses' => 'PagesController@profile'
]);

/*
|--------------------------------------------------------------------------
| All Users Page
|--------------------------------------------------------------------------
*/

Route::get('users', [
    'as'   => 'users',
    'uses' => 'UsersController@index'
]);

/*
|--------------------------------------------------------------------------
| User Profile Page
|--------------------------------------------------------------------------
*/

Route::get('@{id}', [
    'as'   => 'show',
    'uses' => 'UsersController@show'
]);

/*
|--------------------------------------------------------------------------
| Follow And Unfollow A User
|--------------------------------------------------------------------------
*/

Route::post('follows', [
    'as'   => 'follows_path',
    'uses' => 'FollowersController@store'

]);

Route::post('follows/{id}', [
    'as'   => 'follow_path',
    'uses' => 'FollowersController@destroy'

]);

/*
|--------------------------------------------------------------------------
| Like And Unlike A Status
|--------------------------------------------------------------------------
*/

Route::post('likes', [
    'as'   => 'likes_path',
    'uses' => 'LikesController@store'

]);

Route::post('likes/{id}', [
    'as'   => 'likes_path',
    'uses' => 'LikesController@destroy'

]);

/*
|--------------------------------------------------------------------------
| Comment On A Status
|--------------------------------------------------------------------------
*/

Route::post('comments', [
    'as'   => 'comments_path',
    'uses' => 'CommentsController@store'

]);

/*
|--------------------------------------------------------------------------
| Settings Page
|--------------------------------------------------------------------------
*/

Route::get('settings', [
    'as'   => 'settings',
    'uses' => 'PagesController@settings'
]);

Route::post('settings', [
    'as'   => 'settings',
    'uses' => 'PagesController@update_settings'
]);

/*
|--------------------------------------------------------------------------
| About Page
|--------------------------------------------------------------------------
*/

Route::get('about', [
    'as'   => 'about',
    'uses' => 'PagesController@about'
]);