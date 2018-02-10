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


Route::any('/engine/superuser/', 'SuperUser\SuperUserController@index');
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

// Send Reset Code
Route::any('/user/actions/sendResetCode', 'Api\User\Actions\ResetPassController@sendResetCode');
// Reset Code
Route::any('/user/actions/resetPass', 'Api\User\Actions\ResetPassController@resetPass');


// -------------- LANG ----------------------//

Route::get('/user/setlocale/{locale}', 'Api\User\Actions\LocaleController@setLocale');

// Route::get('setlocale/{locale}', function ($locale) {
//
//     # Проверяем, что у пользователя выбран доступный язык
//     if (in_array($locale, \Config::get('app.locales'))) {
//          # И устанавливаем его в сессии под именем locale
//     	Session::put('locale', $locale);
//     }
//
//     return redirect()->back();
//
// });

// -------------- LANG ----------------------//





// --------------- CHITS ------------------- //
// Add New Chits
Route::any('/api/user/addChits', 'Api\User\Chits\ChitsController@addChits');
// Delete Chits
Route::any('/api/user/deleteChits', 'Api\User\Chits\ChitsController@deleteChits');
// Copy Chits
Route::any('/api/user/copyChits', 'Api\User\Chits\ChitsController@copyChits');
// Show Chits
Route::any('/api/user/showChits', 'Api\User\Chits\ShowChitsController@showChits');

// --------------- CHITS ------------------- //

// --------------- GROUPS ------------------- //
// Add New group
Route::any('/api/user/addGroup', 'Api\User\Chits\GroupController@addGroup');
// Copy Group
Route::any('/api/user/copyGroup', 'Api\User\Chits\GroupController@copyGroup');
// Delete Chits Group
Route::any('/api/user/deleteGroup', 'Api\User\Chits\GroupController@deleteGroup');
// --------------- GROUPS ------------------- //
