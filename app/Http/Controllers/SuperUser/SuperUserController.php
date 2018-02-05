<?php

namespace App\Http\Controllers\SuperUser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\UsersModel;

class SuperUserController extends Controller
{
    public function index() {
        $usersModel = new UsersModel;
        $user = $usersModel->getUser();

        $admins = [
            '1' => 'halilov.lib@gmail.com',
            '2' => 'hov-dev@protonmail.ch',
        ];

        // если не админ, досвидания
        if(!in_array($user->email, $admins)) {
            return redirect('/');
        }





        $allUsers = $usersModel->allUsers();

        return view('superuser.index')
            ->with('user', $user)
            ->with('allUsers', $allUsers);
    }
}
