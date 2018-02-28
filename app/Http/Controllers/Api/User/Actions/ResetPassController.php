<?php

namespace app\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;
use app\Models\Auth\UsersModel;
use app\Models\Auth\ResetPassModel;

class ResetPassController extends Controller
{
    public function sendResetCode(Request $request) {
        $request->validate([
            'userEmail' => 'required',
        ]);

        $usersModel = new UsersModel;
        $resetPassModel = new ResetPassModel;

        $userEmail = $request->userEmail;

        $checkUser = $usersModel->searchByEmail($userEmail);
        //если пользователь не найден, возвращаем сообщение и код ошибки
        if($checkUser['status'] == 0) {
            return $checkUser;
        }

        // генерируем код
        $resetCode = md5(microtime(true));

        // вставляем код в базу
        $data['resetCode'] = $resetCode;
        $data['userEmail'] = $userEmail;
        $data['user_id'] = $usersModel->getUserIdByEmail($userEmail);
        $addCode = $resetPassModel->addCode($data);

        if(is_null($addCode)) {
            $result['status'] = 0;
            $result['msg'] = 'code add error';
            return $result;
        }


        // отправляем письмо с кодом
        $subject = 'NetChits - Are You Forgot Password ?';
        $message = 'Password Reset Code: ' . $resetCode;
        $headers = 'From: noreply@netchits.com';
        $to = $data['userEmail'];

        // if(mail($userEmail, $subject, $message, $headers)) {
        if(mail($to, $subject, $message, $headers)) {
            $result['status'] = 1;
            $result['msg'] = 'code send succesfully';
        } else {
            $result['status'] = 0;
            $result['msg'] = 'code send fails';
        }


        return $result;

    }

    public function resetPass(Request $request) {
        $usersModel = new UsersModel;
        $resetPassModel = new ResetPassModel;

        $data['userEmail'] = $request->userEmail;
        $data['code'] = $request->code;
        $data['newpass'] = $request->newpass;
        $data['repass'] = $request->repass;

        if($data['newpass'] !== $data['repass']) {
            $result['status'] = 0;
            $result['msg'] = 'passwords not equals';
            return $result;
        }



        $user = $usersModel->getUserByEmail($data['userEmail']);
        if(is_null($user)) {
            $result['status'] = 1;
            $result['msg'] = 'user not exists';
            return $result;
        }
        $data['user_id'] = $user->id;


        $checkCode = $resetPassModel->checkCode($data['code'], $user->id);
        if($checkCode['status'] != 1) {
            return $checkCode;
        }


        $resetPass = $usersModel->resetPass($data);
        if($resetPass['status'] !=1) {
            return $resetPass;
        }

        $result['status'] = 1;
        $result['msg'] = 'password update successfully';
        return $result;


    }
}
