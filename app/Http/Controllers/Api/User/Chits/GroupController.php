<?php

namespace App\Http\Controllers\Api\User\Chits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;
//-------------------App Models---------------------//

class GroupController extends Controller
{
    public function addGroup(Request $request) {

    // SECTION : Models & Controllers
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

    // SECTION : Request
        $chitsGroup = $request->chitsGroup;

    // SECTION : Logics

        $user = $usersModel->getUser();
        $addGroup = $chitsGroupModel->addGroup($chitsGroup, $user);
        // $userChitsGroups = $chitsGroupModel->getUserGroups($user);

        return $userChitsGroups;


    }
}
