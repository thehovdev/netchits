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
use app\Models\User\ChitsModel;
use app\Models\User\ChitsGroupModel;

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
            $result['msg'] = 'Netchits Available Only For 14 years old';
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

        $confirmcode = md5('confirmcode' . time());
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
        $cookieTime = strtotime( '+365 days' );
        $cookieDir = '/';

        setcookie("auth", "success", $cookieTime, $cookieDir);
        setcookie("email", $result['email'], $cookieTime, $cookieDir);
        setcookie("secret", $result['secret'], $cookieTime, $cookieDir);


        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

    public function tryDemo(Request $requst) {
        // SECTION : Models
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Controllers
        $dataController = new DataController;

        // SECTION : Logics
        $time = microtime(true);
        // убираем точку из микросекунд
        $time = str_replace(".", "", $time);
        // создаем уникальное имя юзера


        $userData = [];
        $userData['email'] = "user" . $time . "@netchits.com";
        $userData['password'] = "user" . $time;
        $userData['hashtag'] = "user" . $time;
        $userData['age'] = "true";

        // hash password
        $hash = password_hash($userData['password'], PASSWORD_DEFAULT);

        // generate unique secret from hash + time
        $secretOpen = md5($hash) . time();
        $secret = uniqid($secretOpen);
        // generate confirm code
        $confirmcode = md5('confirmcode' . time());
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
        $user = $usersModel->addUser($protectedData);
        // Step 2 : Check Error
        if($user['status'] !== 1) {
            return $user;
        }

        // Step 3 : Auth User
        $cookieTime = strtotime( '+365 days' );
        $cookieDir = '/';

        setcookie("auth", "success", $cookieTime, $cookieDir);
        setcookie("email", $user['email'], $cookieTime, $cookieDir);
        setcookie("secret", $user['secret'], $cookieTime, $cookieDir);




        // Step 4 : Add default Groups
        $demoGroups = $chitsGroupModel->addDemoGroups($user);
        // Step 4 : Add default Chits
        $demoChits = $chitsModel->addDemoChits($user, $demoGroups);



        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }

}
