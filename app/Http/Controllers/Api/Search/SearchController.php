<?php

namespace App\Http\Controllers\Api\Search;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;
use App\Models\Friends\FriendsModel;

class SearchController extends Controller
{
    public function search(Request $request) {
        // SECTION : MODELS
        $usersModel = new UsersModel;
        $friendsModel = new FriendsModel;



        $user = $usersModel->getUser();
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
        // $result['id'] = $friend['id'];

        return $result;


    }
}
