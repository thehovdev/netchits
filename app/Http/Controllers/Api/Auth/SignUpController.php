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


class SignUpController extends Controller
{

    public function signUp(Request $request) {

    // SECTION : Models
        $usersModel = new UsersModel;
    // SECTION : Controllers
        $dataController = new DataController;

    // SECTION : Request
        $userData = [];
        $userData['email'] = $request->userEmail;
        $userData['password'] = $request->userPassword;

    // SECTION : Logics

        // hash password
        $hash = password_hash($userData['password'], PASSWORD_DEFAULT);

        // generate unique secret from hash + time
        $secretOpen = $hash . time();
        $secret = $dataController->encryptOpenssl($secretOpen);


        $protectedData = [];
        $protectedData['email'] = $userData['email'];
        $protectedData['password'] = $hash;
        $protectedData['secret'] = $secret;


        // Step 1 : Check if User Exists
        $result = $usersModel->checkSignUp($protectedData);
        // Step 1 : Check Error
        if($result['status'] !== 1) {
            return $result;
        }


        // Step 2 : Add User to DataBase
        $result = $usersModel->addUser($protectedData);
        // Step 2 : Check Error
        if($result['status'] !== 1) {
            return $result;
        }


        // Step 3 : Auth User
        $cookieTime = strtotime( '+7 days' );
        $cookieDir = '/';

        setcookie("auth", "success", $cookieTime, $cookieDir);
        setcookie("email", $result['email'], $cookieTime, $cookieDir);
        setcookie("secret", $result['secret'], $cookieTime, $cookieDir);


        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }
}
