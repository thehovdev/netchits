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
