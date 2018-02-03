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

        // SECTION : Logics
        if(!isset($_COOKIE['auth']) && @$_COOKIE['auth'] !== 'success') {
                return view("layouts.start");
        } else {

            $user = $usersModel->getUser();
            $userGroups = $chitsGroupModel->getUserGroups($user);
            $userChits = $chitsModel->getUserChits($user);
            $friends = $user->friends; // laravel relations (отношения)




            return view("user.profile")
                ->with("user", $user)
                // ->with("friends", $friends)
                ->with("userChits", @$userChits)
                ->with("userGroups", @$userGroups);
        }
    }
}
