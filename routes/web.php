<?php

use Illuminate\Support\Facades\Route;

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
})->middleware('guest');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/settings', 'UserController@settings')->name('settings');

Route::get('/locale/{locale}', 'LocaleController@set')->name('locale');

Route::post('/upload/image', 'UserController@upload')->name('update.picture');

Route::post('/settings/update', 'UserController@apply')->name('update.settings');

Route::resource('chits', 'ChitController', ['except' => ['index']]);

Route::resource('groups', 'GroupController', ['except' => ['index']]);

Route::post('/non-sign-up', 'UserController@continue')->name('without.register');

Route::get('/user/{user}', 'UserController@show')->name('user.show');

Route::post('/follow', 'FollowerController@follow')->name('follow');

Route::post('/unfollow', 'FollowerController@unfollow')->name('unfollow');
