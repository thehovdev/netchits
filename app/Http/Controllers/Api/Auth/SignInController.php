<?php

//----------------Laravel--------------------//
namespace app\Http\Controllers\Api\Auth;
use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
//----------------Laravel--------------------//

//-------------------App Controllers---------------------//
use app\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use app\Models\Auth\UsersModel;
//-------------------App Models---------------------//


class SignInController extends Controller
{
    public function signIn(Request $request) {

        $usersModel = new UsersModel;

        $request->validate([
            'userEmail' => 'required',
            'userPassword' => 'required',
        ]);


        $userData = [];
        $userData['email'] = $request->userEmail;
        $userData['password'] = $request->userPassword;

        // Step 1 : Check if User Exists
        $result = $usersModel->checkSignIn($userData);
        if($result['status'] === 0) {
            return $result;
        }


        // Step 2 : Auth User
        $cookieTime = strtotime( '+7 days' );
        $cookieDir = '/';

        setcookie("auth", "success", $cookieTime, $cookieDir);
        setcookie("email", $result['email'], $cookieTime, $cookieDir);
        setcookie("secret", $result['secret'], $cookieTime, $cookieDir);


        // return $result;
        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }

}
