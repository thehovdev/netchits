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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::any('/', 'StartController@homePage');
Route::any('/api/auth/signUp', 'Api\Auth\SignUpController@signUp');
Route::any('/api/auth/signIn', 'Api\Auth\SignInController@signIn');
