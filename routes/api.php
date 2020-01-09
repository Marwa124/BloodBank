<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'namespace' => 'Api'], function () {
    Route::get('governorates', 'MainController@governorates');
    Route::get('cities', 'MainController@cities');
    Route::get('categories', 'MainController@categories');
    Route::get('bloodtypes', 'MainController@bloodTypes');
    Route::get('settings', 'MainController@settings');
    Route::post('contactus', 'MainController@contactUs');
    Route::post('register', 'AuthController@register');
    Route::post('forget-password', 'AuthController@resetPassword');

    Route::group(['middleware' => 'throttle:5,1'], function() {
        Route::post('login', 'AuthController@login');
    });

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('notifications', 'MainController@notifications');
        Route::get('notification-settings', 'MainController@getNotificationSettings');
        Route::post('notification-settings', 'MainController@notificationSettings');
        Route::get('profile', 'AuthController@profile');
        Route::get('posts', 'MainController@posts');
        Route::get('post', 'MainController@post');
        Route::get('favorite-list', 'MainController@favoriteList');
        Route::get('favorite-post', 'MainController@favoritePost');
        Route::get('donation-list', 'MainController@donationList');
        Route::get('donation', 'MainController@donation');
        Route::post('create-donation', 'MainController@createDonation');
        Route::post('test-notification', 'MainController@testNotification');
        Route::post('register-token', 'AuthController@registerToken');
        Route::post('remove-token', 'AuthController@removeToken');
    });

});
