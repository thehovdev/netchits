<?php

namespace App\Http\Controllers;

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
            return view("layouts.start");
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
