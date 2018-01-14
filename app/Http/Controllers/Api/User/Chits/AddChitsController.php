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

use App\Http\Lib\OpenGraph;



class AddChitsController extends Controller
{
    public function addChits(Request $request) {

    // SECTION : Models & Controllers
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        $dataController = new DataController;
    // SECTION : Request
        $chitsAddress = $request->chitsAddress;
        $chitsGroupId = $request->chitsGroupId;
    // SECTION : Logics
        $user = $usersModel->getUser();

        $chits = $chitsModel->addNew($user, $chitsAddress, $chitsGroupId);
        if($chits['status'] !== 1) {
            return $chits;
        }



    // SECTION : Result

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
