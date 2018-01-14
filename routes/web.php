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

// Testing
Route::any('/api/test', 'TestController@test');


// Home
Route::any('/', 'StartController@homePage');
// Sign Up
Route::any('/api/auth/signUp', 'Api\Auth\SignUpController@signUp');
// Sign In
Route::any('/api/auth/signIn', 'Api\Auth\SignInController@signIn');
// Sign Out
Route::any('/api/auth/signOut', 'Api\Auth\SignOutController@signOut');

// User padding-left
Route::any('/user/{id}', 'Api\User\Actions\UserController@showUserProfile');

Route::any('/user/actions/uploadProfileImage', 'Api\User\Actions\UserController@uploadProfileImage');

// --------------- CHITS ------------------- //
// Add New Chits
Route::any('/api/user/addChits', 'Api\User\Chits\AddChitsController@addChits');
// Delete Chits
Route::any('/api/user/deleteChits', 'Api\User\Chits\DeleteChitsController@deleteChits');
// Delete Chits Group
Route::any('/api/user/deleteChitsGroup', 'Api\User\Chits\DeleteChitsController@deleteChitsGroup');
// Show Chits
Route::any('/api/user/showChits', 'Api\User\Chits\ShowChitsController@showChits');
// --------------- CHITS ------------------- //

// --------------- GROUPS ------------------- //
// Add New group
Route::any('/api/user/addGroup', 'Api\User\Chits\GroupController@addGroup');
// --------------- GROUPS ------------------- //
