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

    public function copyGroup(Request $request) {
        // SECTION : Models & Controllers
            $usersModel = new UsersModel;
            $chitsModel = new ChitsModel;
            $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Request
            $groupId = $request->groupId;
            $hashtag = $request->hashtag;
        // SECTION : Logics
            $user = $usersModel->getUser();

            if(is_null($user)) {
                $result['status'] = 0;
                $result['msg'] = 'redirect';
                return $result;
            }

            $friend = $user->getFriend($hashtag);


            $group = $chitsGroupModel->find($groupId);

            // relations
            $chits = $group->chits->all();


            // $chits = $chitsModel->where('group_id', $groupId)->get();

            $copyGroup = $chitsGroupModel->copyGroup($user, $group);

            $copyChit = $chitsModel->copyFromGroup($user, $chits, $copyGroup);


            return $copyChit;
    }

    public function addGroup(Request $request) {

        // SECTION : Models & Controllers
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Request
        $chitsGroup = $request->chitsGroup;

        // SECTION : Logics
        $user = $usersModel->getUser();
        $group = $chitsGroupModel->addGroup($chitsGroup, $user);

        // SECTION : Result
        $userGroups = $chitsGroupModel->getUserGroups($user);
        // $userChits = $chitsModel->getUserChits($user);

        if(is_null($group)) {
            $result['status'] = 0;
            $result['msg'] = 'error when adding group';
            return $result;
        }


        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['group']['id'] = $group->id;
        $result['group']['name'] = $group->name;
        $result['html'] = view('user.chits.includes.group-list')
            ->with('group', $group)
            ->render();
        $result['html_chitsgroup_select'] = view('layouts.includes.chitsgroup-select')
        ->with("userGroups", @$userGroups)
        ->render();


        return response()->json($result);

        // $result['html'] = view('user.chits.chits-list')
        //     ->with("user", $user)
        //     ->with("userChits", @$userChits)
        //     ->with("userGroups", @$userGroups)
        //     ->render();
        //
        // return response()->json($result);

    }

    public function deleteGroup(Request $request) {
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

        $deleted = $chitsGroupModel->remove($user, $groupId);

        if(is_null($deleted)) {
            $result['status'] = 0;
            $result['msg'] = 'error deleting group';
        }


        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['group']['id'] = $deleted->id;

        return $result;


    }

}
