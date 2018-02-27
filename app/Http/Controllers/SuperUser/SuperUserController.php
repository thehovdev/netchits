<?php

namespace NetChits\Http\Controllers\SuperUser;

use Illuminate\Http\Request;
use NetChits\Http\Controllers\Controller;
use NetChits\Models\Auth\UsersModel;

class SuperUserController extends Controller
{
    public function index() {
        $usersModel = new UsersModel;
        $user = $usersModel->getUser();

        $admins = [
            '1' => 'halilov.lib@gmail.com',
            '2' => 'hov-dev@protonmail.ch',
            '3' => 'mrcat323@gmail.com',
        ];

        // если не админ, досвидания
        if(!in_array($user->email, $admins)) {
            return redirect('/');
        }

        // если каким то способом обойдет редирект, всеравно досвидания
        if(!in_array($user->email, $admins)) {
            return false;
        }



        $allUsers = $usersModel->allUsers();

        return view('superuser.index')
            ->with('user', $user)
            ->with('allUsers', $allUsers);
    }
}
