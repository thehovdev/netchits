<?php

namespace NetChits\Http\Controllers;

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

//-------------------App Models---------------------//

class StartController extends Controller
{
    public function homePage() {

        // SECTION : Models
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;
        $user = @$usersModel->getUser();

        // SECTION : Logics
        if(is_null($user)) {
            $sidebar = 'false';

            return view("layouts.start")
                ->with('user', $user)
                ->with('sidebar', $sidebar);
        } else {


            $userGroups = $chitsGroupModel->getUserGroups($user);
            $userChits = $chitsModel->getUserChits($user);
            $friends = $user->friends->take(5);
            $followers = $user->followers->take(5);
            $peoples = $usersModel->getRandomPeoples();

            return view("user.profile")
                ->with("user", @$user)
                ->with("peoples", @$peoples)
                ->with("friends", @$friends)
                ->with("followers", @$followers)
                ->with("userChits", @$userChits)
                ->with("userGroups", @$userGroups);
        }
    }
}
