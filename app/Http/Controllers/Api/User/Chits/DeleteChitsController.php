<?php

namespace App\Http\Controllers\Api\User\Chits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;
//-------------------App Models---------------------//

class DeleteChitsController extends Controller
{

    public function deleteChitsGroup(Request $request) {
    // SECTİON : Models
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;
    // SECTION : Request
        $groupId = $request->groupId;
    // SECTION : Logics
        $user = $usersModel->getUser();


        $is_usergroup = $chitsGroupModel->is_usergroup($user, $groupId);


        if($is_usergroup['status'] == 0) {
            return $is_usergroup;
        }

        //

        $deleteGroups = $chitsGroupModel->remove($user, $groupId);

        if($deleteGroups['status'] == 0) {
            return $deleteGroups;
        }


        $userChits = $chitsModel->getUserChits($user);
        $userGroups = $chitsGroupModel->getUserGroups($user);


        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['html'] = view('user.chits.chits-list')
            ->with("user", $user)
            ->with("userChits", @$userChits)
            ->with("userGroups", @$userGroups)
            ->render();


        return response()->json($result);



    }

    public function deleteChits(Request $request) {

        // SECTION : Models
            $usersModel = new UsersModel;
            $chitsModel = new ChitsModel;
            $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Request
            $chitsId = $request->chitsId;
        // SECTION : Logics
            $user = $usersModel->getUser();

            $is_userchits = $chitsModel->is_userchits($user, $chitsId);


            if($is_userchits['status'] == 0) {
                return $is_userchits;
            }



            $deleteChits = $chitsModel->remove($user, $chitsId);

            if($deleteChits['status'] == 0) {
                return $deleteChits;
            }


            $userChits = $chitsModel->getUserChits($user);
            $userGroups = $chitsGroupModel->getUserGroups($user);


            $result['status'] = 1;
            $result['msg'] = 'success';
            $result['html'] = view('user.chits.chits-list')
                ->with("user", $user)
                ->with("userChits", @$userChits)
                ->with("userGroups", @$userGroups)
                ->render();


            return response()->json($result);

    }
}
