<?php

namespace App\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\UsersModel;
use App\Models\Auth\ResetPassModel;

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

        // if(mail($userEmail, $subject, $message, $headers)) {
        if(mail('halilov.lib@gmail.com', 'My Subject', $message)) {
            $result['status'] = 1;
            $result['msg'] = 'code send succesfully';
        } else {
            $result['status'] = 0;
            $result['msg'] = 'code send fails';
        }

        // print phpinfo();


        return $result;

    }
}
