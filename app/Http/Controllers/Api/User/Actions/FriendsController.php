<?php

namespace app\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use app\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use app\Models\Auth\UsersModel;
use app\Models\User\ChitsModel;
use app\Models\User\ChitsGroupModel;
use app\Models\Friends\FriendsModel;

class FriendsController extends Controller
{
    public function addFriend(Request $request) {

        // SECTION : Models
        $friendsModel = new FriendsModel;
        $usersModel = new UsersModel;

        // SECTION : Requests
        $hashtag = $request->hashtag;

        // SECTION : Logics
        $user = $usersModel->getUser();
        $friend = $usersModel->getFriend($hashtag);


        $addFriend = $friendsModel->add($user, $friend);

        return $addFriend;
    }

    public function deleteFriend(Request $request) {
        // SECTION : Models
        $friendsModel = new FriendsModel;
        $usersModel = new UsersModel;

        // SECTION : Requests
        $hashtag = $request->hashtag;

        // SECTION : Logics
        $user = $usersModel->getUser();
        $friend = $usersModel->getFriend($hashtag);

        $deleteFriend = $friendsModel->deleteFriend($user, $friend);


        return $deleteFriend;
    }

    public function showFriends(Request $request) {
        // SECTION : Models
        $friendsModel = new FriendsModel;
        $usersModel = new UsersModel;

        // SECTION : Logics
        $user = $usersModel->getUser();

        $friends = $user->friends; // laravel relations (отношения)

        // foreach ($friends as $friend) {
        //     dd($friend->user);
        // }


        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['html'] = view('layouts.includes.friends-list')
            ->with("user", $user)
            ->with("friends", @$friends)
            ->render();

        return response()->json($result);
    }




}
