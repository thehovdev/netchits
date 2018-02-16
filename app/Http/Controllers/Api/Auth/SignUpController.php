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
        $request->validate([
            'userEmail' => 'required',
            'userPassword' => 'required',
            'userHashTag' => 'required',
            'userAge' => 'required',
        ]);

        if($request->userAge != 'true') {
            $resut['status'] = 0;
            $result['msg'] = 'Netchits Available Only For 18 years old';
            return $result;
        }



        $userData = [];
        $userData['email'] = $request->userEmail;
        $userData['password'] = $request->userPassword;
        $userData['hashtag'] = $request->userHashTag;
        $userData['age'] = $request->userAge;


    // SECTION : Logics

        // hash password
        $hash = password_hash($userData['password'], PASSWORD_DEFAULT);

        // generate unique secret from hash + time
        // $secretOpen = $hash . microtime(true);
        $secretOpen = md5($hash) . time();
        $secret = uniqid($secretOpen);

        // $secret = $dataController->encryptOpenssl($secretOpen);

        $confirmcode = encrypt(md5('confirmcode' . time()));
        $confirmcode = substr($confirmcode, 0, 11);



        $protectedData = [];
        $protectedData['email'] = $userData['email'];
        $protectedData['hashtag'] = $userData['hashtag'];
        $protectedData['age'] = $userData['age'];
        $protectedData['password'] = $hash;
        $protectedData['secret'] = $secret;
        $protectedData['confirmcode'] = $confirmcode;

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



        // send confirm code
        $subject = 'NetChits - Confirm Account ';
        $message = 'Please Confirm You Account,
        insert this code on you profile page: ' . $confirmcode;
        $headers = 'From: noreply@netchits.com';
        $to = $userData['email'];
        if(!mail($to, $subject, $message, $headers)) {
            $result['status'] = 0;
            $result['msg'] = 'error send account confirm mail';
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
