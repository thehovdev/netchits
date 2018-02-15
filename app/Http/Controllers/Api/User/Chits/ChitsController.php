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


class ChitsController extends Controller
{

    public function copyChits(Request $request) {
        // SECTION : Models & Controllers
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;
        // SECTION : Request
        $chitId = $request->chitId;

        // SECTION : Logics
        $user = $usersModel->getUser();

        if(is_null($user)) {
            $result['status'] = 0;
            $result['msg'] = 'redirect';
            return $result;
        }

        $chit = $chitsModel->copy($user, $chitId);

        return $chit;
    }

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

        $chit = $chitsModel->addNew($user, $chitsAddress, $chitsGroupId);

        if(is_null($chit)) {
            $result['status'] = 0;
            $result['msg'] = 'error, chit not added';
        }

        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['chit']['group_id'] = $chit->group_id;

        if($chit->opg_sitename == 'youtube') {
            $result['html'] = view('user.chits.includes.video-list')
                ->with("chit", $chit)
                ->render();
        } else {
            $result['html'] = view('user.chits.includes.default-list')
                ->with("chit", $chit)
                ->render();
        }

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

            $deleted = $chitsModel->remove($user, $chitsId);

            if(is_null($deleted)) {
                return 'error delete chits';
            }

            $result['status'] = 1;
            $result['msg'] = 'success';
            $result['chit']['group_id'] = $deleted->group_id;
            $result['chit']['id'] = $deleted->id;
            // $result['html'] = view('user.chits.chits-list')
            //     ->with("user", $user)
            //     ->with("userChits", @$userChits)
            //     ->with("userGroups", @$userGroups)
            //     ->render();

            return response()->json($result);
    }

}
