<?php

namespace app\Http\Controllers;

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
