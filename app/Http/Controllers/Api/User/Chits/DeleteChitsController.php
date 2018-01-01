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
