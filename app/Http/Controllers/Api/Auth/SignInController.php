<?php

//----------------Laravel--------------------//
namespace App\Http\Controllers\Api\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//----------------Laravel--------------------//

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//


//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
//-------------------App Models---------------------//


class SignInController extends Controller
{
    public function signIn(Request $request) {

        $usersModel = new UsersModel;

        $userData = [];
        $userData['email'] = $request->userEmail;
        $userData['password'] = $request->userPassword;

        // Step 1 : Check if User Exists
        $result = $usersModel->checkSignIn($userData);

        return $result;
    }

}
