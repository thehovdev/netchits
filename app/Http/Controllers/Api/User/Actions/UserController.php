<?php

namespace app\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use app\Http\Controllers\Controller;


//-------------------App Controllers---------------------//
use app\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use app\Models\Auth\UsersModel;
use app\Models\Friends\FriendsModel;
use app\Models\User\ChitsModel;
use app\Models\User\ChitsGroupModel;

class UserController extends Controller
{

    public function detailFollows($id) {
        // SECTION : Models
        $usersModel = new UsersModel;
        $friendsModel = new FriendsModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;

        // SECTION : Logics
        $user = $usersModel->getUser();
        $userprofile = $usersModel->find($id);
        $friends = $userprofile->friends; // laravel relations (отношения)
        $followers = $userprofile->followers; // laravel relations

        return view('user.followsdetail')
            ->with('user', $user)
            ->with('userprofile', $userprofile)
            ->with('friends', $friends)
            ->with('followers', $followers);
    }

    public function showUserNoAuth($id) {
        $usersModel = new UsersModel;
        $friendsModel = new FriendsModel;
        $chitsModel = new ChitsModel;
        $chitsGroupModel = new ChitsGroupModel;


        $userprofile = $usersModel->find($id);
        $userChits = $chitsModel->getUserChits($userprofile);
        $userGroups = $chitsGroupModel->getUserGroups($userprofile);
        $friends = $userprofile->friends->take(5); // laravel relations (отношения)
        $followers = $userprofile->followers->take(5); // laravel relations


        return view('user.userprofileNoAuth')
            ->with('sidebar', 'true')
            ->with('userprofile', $userprofile)
            ->with('userChits', $userChits)
            ->with('userGroups', $userGroups)
            ->with('friends', $friends)
            ->with('followers', $followers);



        // return view('test');

    }

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

        if(is_null($user)) {
            // $this->showUserNoAuth($id);

            $userprofile = $usersModel->find($id);
            $userChits = $chitsModel->getUserChits($userprofile);
            $userGroups = $chitsGroupModel->getUserGroups($userprofile);
            $friends = $userprofile->friends->take(5);
            $followers = $userprofile->followers->take(5); // laravel relations


            return view('user.userprofileNoAuth')
                ->with('userprofile', $userprofile)
                ->with('userChits', $userChits)
                ->with('userGroups', $userGroups)
                ->with('friends', $friends)
                ->with('followers', $followers);

        }






        // если id == id текущего пользователя
        // значит пользователь заходит на свою страницу
        // иначе пользователь заходит на чужую страницу

        if($userprofile->id == $user->id) {
            $user->permission = 'user';

            $friends = $user->friends; // laravel relations (отношения)
            $followers = $user->followers; // laravel relations

            return view('user.userprofile')
                ->with('user', $user)
                ->with('friends', $friends)
                ->with('followers', $followers);
        }
        elseif($userprofile->id != $user->id) {
            $user->permission = 'guest';
            $userChits = $chitsModel->getUserChits($userprofile);
            $userGroups = $chitsGroupModel->getUserGroups($userprofile);
            $is_friends = $usersModel->is_friend($userprofile->id);



            $friends = $userprofile->friends->take(5); // laravel relations (отношения)
            $followers = $userprofile->followers->take(5); // laravel relations



            return view('user.userprofile')
                ->with('user', $user)
                ->with('is_friends', $is_friends)
                ->with('userprofile', $userprofile)
                ->with('userChits', $userChits)
                ->with('userGroups', $userGroups)
                ->with('friends', $friends)
                ->with('followers', $followers);
        }

    }

    public function updateProfile(Request $request) {
        // SECTION : Models
        $usersModel = new UsersModel;
        $user = $usersModel->getUser();
        // SECTION : Request
        $hashtag = $request->hashtag;
        $confirmcode = $request->confirmcode;

        // SECTION : Logics
        if(is_null($hashtag)) {
            $result['status'] = 0;
            $result['msg'] = 'hashtag not be empty';
            return $result;
        }

        $hashtagCount = substr_count($hashtag, '#');
        if($hashtagCount > 1) {
            $result['status'] = 1;
            $result['msg'] = 'hashtag symbol can be only 1';
            return $result;
        }





        $hashtagCheck = $usersModel->checkHashtag($hashtag, $user);

        if($hashtagCheck['status'] == 0) {
            return $hashtagCheck;
        }

        $hashtagUpdate = $usersModel->updateProfile($hashtag, $confirmcode);

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

            $destinationPath = public_path('storage/user-profile-images/');
            $image->move($destinationPath, $image_id);


            $updateImage =$usersModel->updateImage($image_id);




            $result = [];
            $result['status'] = 1;
            $result['msg'] = 'success';

            return $result;
        }

    }
}
