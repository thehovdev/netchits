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

        $usersModel = new UsersModel;



        $userData = [];
        $userData['email'] = $request->userEmail;
        $userData['password'] = $request->userPassword;


        //hash password
        $hash = password_hash($userData['password'], PASSWORD_DEFAULT);


        $protectedData = [];
        $protectedData['email'] = $userData['email'];
        $protectedData['password'] = $hash;


        // Step 1 : Check if User Exists
        $result = $usersModel->checkSignUp($protectedData);


        // Step 2 : Add User to DataBase
        if($result['status'] == 1) {
            $result = $usersModel->addUser($protectedData);
        }


        return $result;
    }
}
