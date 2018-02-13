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
        $chitsGroupModel = new ChitsGroupModel;
        $usersModel = new UsersModel;

        $user = $usersModel->getUser();

        return view('test')->with('user', $user);
        // return view('test2')->with('user', $user);



        // $group = $chitsGroupModel->find(22);
        // dd($group->chits->all());


        // $user = $usersModel->find(38);
        // dd($user->groups->all());

        // $group = $chitsGroupModel->find(22);

        // $chits = $group->chits;
        // foreach ($chits as $chit) {
        //     dd($chit->group);
        // }





        // $chits = $chitsModel->all();
        // foreach ($chits as $chit) {
        //     dd($chit->group);
        // }







        // $address = UsersModel::find(38)->userid;
        // dd($address);

        // один к одному

        // $users = $usersModel->all();
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
