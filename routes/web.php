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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Front', 'prefix' => 'client'], function() {
  Route::get('client-register', 'AuthController@clientRegister')->name('client.register');
  Route::post('client-register-save', 'AuthController@clientRegisterSave')->name('client.save');
  Route::get('client-login', 'AuthController@clientLogin')->name('client.login');
  Route::post('client-login-save', 'AuthController@clientLoginSave')->name('client.logged');
  Route::get('/', 'FrontController@home')->name('master');

  Route::group(['middleware' => 'auth:client'], function(){
    Route::get('client-logout', 'FrontController@logout');
    Route::get('about', 'FrontController@about')->name('about');
    Route::get('artical-details/{id}', 'FrontController@postDetails')->name('post.details');
    Route::get('articals', 'FrontController@posts')->name('posts');
    Route::get('artical-search', 'FrontController@postSearch')->name('post.search');
    Route::get('favorate-post', 'FrontController@favoratePost')->name('favorate.post');
    Route::get('donation', 'FrontController@donation')->name('donation');
    Route::get('client-donation/{id}', 'FrontController@clientDonation')->name('client.donation');
    Route::get('donation-search', 'FrontController@donationSearch')->name('donation.search');
    Route::get('create-donation', 'FrontController@createDonation')->name('create.donation');
    Route::post('create-donation', 'FrontController@saveDonation')->name('save.donation');
    Route::get('donation-details/{id}', 'FrontController@donationDetails')->name('donation.details');

    Route::get('notification-settings/{id}/edit', 'FrontController@notificationSetting')->name('notification.setting');
    Route::put('notification-settings/{id}', 'FrontController@saveNotificationSetting')->name('notification.save');

    Route::post('toggle-favorite', 'FrontController@toggleFavorite')->name('favorable');
  });
});

Auth::routes();


Route::group(['middleware' => ['auth', 'auto-check-permission'], 'prefix' => 'admin'], function(){

  Route::get('/home', 'HomeController@index');

  Route::get('user/change-password', 'UserController@changePassword')->name('user.password');
  Route::post('user/change-password', 'UserController@changePasswordSave')->name('user.password.save');
  Route::post('setting/{id}', 'SettingController@image')->name('image');
  Route::delete('delete-all-post', 'PostController@deleteAll')->name('delete.all.post');

  Route::resource('governorate', 'GovernorateController');
  Route::resource('city', 'CityController');
  Route::resource('client', 'ClientController');
  Route::resource('user', 'UserController');
  Route::resource('role', 'RoleController');
  Route::resource('post', 'PostController');
  Route::resource('category', 'CategoryController');
  Route::resource('donation', 'DonationController');
  Route::resource('setting', 'SettingController');
});
