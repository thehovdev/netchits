<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;
use App\Models\Friends\FriendsModel;
//-------------------App Models---------------------//


class TestController extends Controller
{
    public function test() {

        $chitsModel = new ChitsModel;
        $usersModel = new UsersModel;

        // $address = UsersModel::find(38)->userid;
        // dd($address);

        // один к одному

        // $users = $usersModel->all();
        //
        // foreach ($users as $user) {
        //     dd($user->chits);
        // }

        // один к одному обратное

        // $chits = $chitsModel->all();
        //
        // foreach ($chits as $chit) {
        //     dd($chit->user);
        // }

        // один ко многим

        // $users = $usersModel->all();
        // foreach ($users as $user) {
        //     dd($user->chitsMany);
        // }

        // многие ко многим

        // $chits = $chitsModel->all();
        //
        // foreach ($chits as $chit) {
        //     dd($chit->userMany);
        // }

    }
}
