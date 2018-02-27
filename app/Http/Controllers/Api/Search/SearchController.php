<?php

namespace NetChits\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use NetChits\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use NetChits\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use NetChits\Models\Auth\UsersModel;
use NetChits\Models\User\ChitsModel;
use NetChits\Models\User\ChitsGroupModel;
use NetChits\Models\Friends\FriendsModel;

class SearchController extends Controller
{
    public function search(Request $request) {
        // SECTION : MODELS
        $usersModel = new UsersModel;
        $friendsModel = new FriendsModel;

        $user = $usersModel->getUser();

        if(is_null($user)) {
            $result['status'] = 2;
            $result['msg'] = 'register for search';
            return $result;
        }


        // SECTION : Requests
        $search = $request->search;
        if($user->hashtag == $search) {
            $result['status'] = 0;
            $result['msg'] = 'You Cannot follow yourself';
            return $result;
        }

        // SECTION : Logics
        $friend = $usersModel->search($search);
        if($friend['status'] == 0) {
            return $friend;
        }

        $is_friends = $user->friends
            ->where('friend_id', $friend['id'])
            ->first();


        if(!is_null($is_friends)) {
            $result['is_friends'] = 1;
        } else {
            $result['is_friends'] = 0;
        }

        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['hashtag'] = $friend['hashtag'];
        $result['image_id'] = $friend['image_id'];
        $result['id'] = $friend['id'];

        return $result;


    }
}
