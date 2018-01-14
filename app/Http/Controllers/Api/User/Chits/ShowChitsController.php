<?php

namespace App\Http\Controllers\Api\User\Chits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
//-------------------App Models---------------------//

class ShowChitsController extends Controller
{
    public function showChits() {

        // SECTION : Models
            $usersModel = new UsersModel;
            $chitsModel = new ChitsModel;

        // SECTION : Logics

            $user = $usersModel->getUser();
            $userChits = $chitsModel->getUserChits($user);

            $result = view('user.profile')
                ->with("user", $user)
                ->with("userChits", $userChits)
                ->render();

            return response()->json($result);

    }
}
