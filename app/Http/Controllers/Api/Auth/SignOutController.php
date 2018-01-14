<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

class SignOutController extends Controller
{
    public function signOut() {
        $dataController = new DataController;

        $dataController->cookieNull("email");
        $dataController->cookieNull("auth");
        $dataController->cookieNull("secret");

        $result = [];
        $result['msg'] = 'success';
        $result['status'] = 1;
        $result['html'] = view('layouts.start')
            ->render();

        return response()->json($result);

    }
}
