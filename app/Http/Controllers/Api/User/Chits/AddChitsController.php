<?php

namespace app\Http\Controllers\Api\User\Chits;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use app\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use app\Models\Auth\UsersModel;
use app\Models\User\ChitsModel;
use app\Models\User\ChitsGroupModel;
//-------------------App Models---------------------//

use app\Http\Lib\OpenGraph;



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

    public function copyChits(Request $request) {
        // SECTION : Models & Controllers
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;
        // SECTION : Request
        $chitId = $request->chitId;

        // SECTION : Logics
        $user = $usersModel->getUser();

        $chit = $chitsModel->copy($user, $chitId);

        return $chit;
    }

}
