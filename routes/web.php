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

//  Route::get('/', function () {
//      return view('welcome');
//  });

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


// Search
Route::any('/api/user/search', 'Api\Search\SearchController@search');

// User Actions
Route::any('/user/{id}', 'Api\User\Actions\UserController@showUserProfile');

Route::any('/user/actions/uploadProfileImage', 'Api\User\Actions\UserController@uploadProfileImage');

Route::any('/user/actions/updateProfile', 'Api\User\Actions\UserController@updateProfile');

Route::any('/user/actions/addFriend', 'Api\User\Actions\FriendsController@addFriend');

Route::any('/user/actions/deleteFriend', 'Api\User\Actions\FriendsController@deleteFriend');

Route::any('/user/actions/showFriends', 'Api\User\Actions\FriendsController@showFriends');

Route::any('/user/actions/showFriends', 'Api\User\Actions\FriendsController@showFriends');

// --------------- CHITS ------------------- //
// Add New Chits
Route::any('/api/user/addChits', 'Api\User\Chits\ChitsController@addChits');
// Copy Chits
Route::any('/api/user/copyChits', 'Api\User\Chits\AddChitsController@copyChits');
// Delete Chits
Route::any('/api/user/deleteChits', 'Api\User\Chits\DeleteChitsController@deleteChits');
// Show Chits
Route::any('/api/user/showChits', 'Api\User\Chits\ShowChitsController@showChits');

// --------------- CHITS ------------------- //

// --------------- GROUPS ------------------- //
// Add New group
Route::any('/api/user/addGroup', 'Api\User\Chits\GroupController@addGroup');
// Copy Group
Route::any('/api/user/copyGroup', 'Api\User\Chits\GroupController@copyGroup');
// Delete Chits Group
Route::any('/api/user/deleteChitsGroup', 'Api\User\Chits\DeleteChitsController@deleteChitsGroup');
// --------------- GROUPS ------------------- //
