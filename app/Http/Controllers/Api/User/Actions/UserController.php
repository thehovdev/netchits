<?php

namespace App\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


//-------------------App Controllers---------------------//
use App\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use App\Models\Auth\UsersModel;
use App\Models\Friends\FriendsModel;
use App\Models\User\ChitsModel;
use App\Models\User\ChitsGroupModel;

class UserController extends Controller
{

    public function showUserProfile($id) {

        // SECTION : Models
        $usersModel = new UsersModel;
        $friendsModel = new FriendsModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Logics

        // пользователь, текущий, который выполнил вход
        $user = $usersModel->getUser();
        // пользователь профиль которого просматриваем
        $userprofile = $usersModel->find($id);
        if(is_null($userprofile)) {
            return back();
        }


        // если id == id текущего пользователя
        // значит пользователь заходит на свою страницу
        // иначе пользователь заходит на чужую страницу

        if($userprofile->id == $user->id) {
            $user->permission = 'user';
            return view('user.userprofile')
                ->with('user', $user);
        }
        elseif($userprofile->id != $user->id) {
            $user->permission = 'guest';

            $userChits = $chitsModel->getUserChits($userprofile);
            $userGroups = $chitsGroupModel->getUserGroups($userprofile);

            return view('user.userprofile')
                ->with('user', $user)
                ->with('userprofile', $userprofile)
                ->with('userChits', $userChits)
                ->with('userGroups', $userGroups);
        }

    }


    public function updateProfile(Request $request) {
        // SECTION : Models
        $usersModel = new UsersModel;

        // SECTION : Request
        $hashtag = $request->hashtag;

        // SECTION : Logics
        if(is_null($hashtag)) {
            $result['status'] = 0;
            $result['msg'] = 'hashtag not be empty';
            return $result;
        }

        $hashtagUpdate = $usersModel->hashtagUpdate($hashtag);

        return $hashtagUpdate;
    }

    public function uploadProfileImage(Request $request) {


        // SECTION : Models
        $usersModel = new UsersModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Logics

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


            $updateImage =$usersModel->updateImage($image_id);




            $result = [];
            $result['status'] = 1;
            $result['msg'] = 'success';

            return $result;
        }

    }
}
