<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request) {

        $userEmail = $request->input('userEmail');
        $userPassword = $request->input('userPassword');

        $result = [];
        $result['status'] = 1;
        $result['userEmail'] = $userEmail;
        $result['userPassword'] = $userPassword;
        return $result;
    }
}
