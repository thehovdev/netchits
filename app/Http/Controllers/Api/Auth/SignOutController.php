<?php

namespace NetChits\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use NetChits\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use NetChits\Http\Controllers\Api\Data\DataController;
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
