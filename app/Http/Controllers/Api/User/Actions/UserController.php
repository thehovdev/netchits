<?php

namespace App\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;

class UserController extends Controller
{
    public function showUserProfile() {

        // SECTION : Models
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Logics
        $user = $usersModel->getUser();

        return view('user.userprofile')
            ->with('user', $user);
    }

    public function uploadProfileImage(Request $request) {



        $this->validate(request(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            if(is_null($image)) {
                return "Image is not defined";
            }

            $image_id = md5($image->getClientOriginalName() . time()) . "." . $image->getClientOriginalExtension();

            $destinationPath = storage_path('/app/public/user-profile-images/');
            $image->move($destinationPath, $image_id);

            $result = [];
            $result['status'] = 1;
            $result['msg'] = 'success';

            return $result;
        }

    }
}
