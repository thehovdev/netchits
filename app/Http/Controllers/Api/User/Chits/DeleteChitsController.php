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
//-------------------App Models---------------------//

class DeleteChitsController extends Controller
{
    public function deleteChits(Request $request) {

        // SECTION : Models
            $usersModel = new UsersModel;
            $chitsModel = new ChitsModel;
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


            $result['status'] = 1;
            $result['msg'] = 'success';
            $result['html'] = view('user.chits.chits-list')
                ->with("user", $user)
                ->with("userChits", $userChits)
                ->render();


            return response()->json($result);

    }
}
