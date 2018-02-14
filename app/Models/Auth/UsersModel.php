<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];
    public $timestamps = true;
    public $result = [];

    public function chits()
    {
        return $this->hasOne('App\Models\User\ChitsModel', 'userid');
    }

    public function groups()
    {
        return $this->hasMany('App\Models\User\ChitsGroupModel', 'user_id');
    }

    public function friends()
    {
        return $this->hasMany('App\Models\Friends\FriendsModel', 'user_id');
    }

    public function followers()
    {
        return $this->hasMany('App\Models\Friends\FriendsModel', 'friend_id');
    }


    public function checkSignUp($protectedData)
    {
        $email = $protectedData['email'];
        $hashtag = $protectedData['hashtag'];
        $checkUser = $this
            ->where('email', $email)
            ->orWhere('hashtag', $hashtag)
            ->first();


        // -----------------RESULT ----------------//
        if(!is_null($checkUser)) {
            $this->result['status'] = 0;
            $this->result['msg'] = "user with this $email or $hashtag already exists";
            return $this->result;
        }

        $this->result['status'] = 1;
        $this->result['email'] = $email;


        return $this->result;
        // -----------------RESULT ----------------//

    }

    public function checkSignIn($userData)
    {
        $email = $userData['email'];
        $password = $userData['password'];

        $checkUser = $this->where([
            ['email', '=', $email],
        ])->first();

        // -----------------RESULT ----------------//

        // check if user exists
        if(is_null($checkUser)) {
            $this->result['status'] = 0;
            $this->result['msg'] = "user with this $email not exists";
            return $this->result;
        }

        // check if user password is correct
        if(!password_verify($password, $checkUser['password'])) {
            $this->result['status'] = 0;
            $this->result['msg'] = "password is incorrect";
            return $this->result;
        }


        $this->result['status'] = 1;
        $this->result['msg'] = 'succes';
        $this->result['email'] = $checkUser->email;
        $this->result['secret'] = $checkUser->secret;

        return $this->result;
        // -----------------RESULT ----------------//

    }

    public function checkConfrim($id)
    {
        $user = $this->find($id);

        $currentDate = strtotime(date('Y-m-d H:i:s'));
        $confirmDate = $user->created_at;
        $confirmDate = strtotime("+2 week", strtotime($confirmDate));

        if($currentDate > $confirmDate) {
            $result['status'] = 0;
            $result['msg'] = 'account will be removed';
            return $result;
        }

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;


    }

    public function deleteUser($id)
    {
        $user = $this->find($id);
        $user->delete();


        \Cookie::forget('email');
        \Cookie::forget('secret');
        \Cookie::forget('auth');

        $result['status'] = 1;
        $result['msg'] = 'user deleted, because not confirm email in 14 days';
        return $result;

        // unset($_COOKIE['email']);
        // unset($_COOKIE['secret']);
        // unset($_COOKIE['auth']);
        // setcookie("auth", null , $cookieTime, $cookieDir);
        // setcookie("email", null, $cookieTime, $cookieDir);
        // setcookie("secret",  null, $cookieTime, $cookieDir);


    }


    public function addUser($usersData)
    {



        $ishashtag = substr($usersData['hashtag'], 0, 1);

        if($ishashtag != '#') {
            $hashtag = "#" . $usersData['hashtag'];
        } else {
            $hashtag = $usersData['hashtag'];
        }




        // insert to database
        $this->email = $usersData['email'];
        $this->hashtag = $hashtag;
        $this->password = $usersData['password'];
        $this->secret = $usersData['secret'];
        $this->confirmcode = $usersData['confirmcode'];
        $this->status = 0;
        $this->save();




        // return result
        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        $this->result['email'] = $usersData['email'];
        $this->result['secret'] = $usersData['secret'];

        return $this->result;
    }

    public function getUser()
    {
        $email = $_COOKIE['email'];
        $secret = $_COOKIE['secret'];
        $user = $this
            ->where('email', $email)
            ->where('secret', $secret)
            ->first();

        return $user;
    }

    public function getUserIdByEmail($email)
    {
        $user = $this
            ->where('email', $email)
            ->first();
        return $user->id;
    }

    public function getUserByEmail($email)
    {

        $user = $this
            ->where('email', $email)
            ->first();

        return $user;
    }

    public function allUsers()
    {
        $allUsers = $this->paginate(20);
        return $allUsers;
    }

    public function is_friend($id) {
        $user = $this->getUser();
        $is_friend = $user->friends->where('friend_id', $id)->first();


        if(!is_null($is_friend)) {
            $result['status'] = 1;
            $result['msg'] = 'friends';
        } else {
            $result['status'] = 0;
            $result['msg'] = 'notfriends';
        }
            return $result;

    }

    public function getFriend($hashtag)
    {
        $friend = $this
            ->where('hashtag', $hashtag)
            ->first();
        return $friend;
    }

    public function getRandomPeoples()
    {
        $peoples = $this->inRandomOrder()->paginate(10);
        return $peoples;
    }

    public function updateImage($image_id)
    {

        if(is_null($image_id)) {
            $result['status'] = 0;
            $result['msg'] = 'Image id not be empty';
            return $result;
        }

        $user = $this->where([
            ['email', '=', $this->getUser()->email],
            ['secret', '=', $this->getUser()->secret]
        ])->first();

        $user->image_id = $image_id;
        $user->save();

        $result['status'] = 1;
        $result['msg'] = 'success';

        return $result;
    }

    public function checkHashtag($hashtaginput, $user) {

        $userhashtag = $user->hashtag;

        $hashtag = $this
            ->where('hashtag', $hashtaginput)
            ->first();


            if(!is_null($hashtag) && $userhashtag != $hashtaginput) {
                $result['status'] = 0;
                $result['msg'] = 'this hashtag already exists';
                return $result;
            } else {
                $result['status'] = 1;
                $result['msg'] = 'success';
                return $result;

            }




}

    public function updateProfile($hashtag, $confirmcode)
    {
        if(is_null($hashtag)) {
            $result['status'] = 0;
            $result['msg'] = 'hashtag id not be empty';
            return $result;
        }

        $user = $this
            ->where('email', $this->getUser()->email)
            ->where('secret', $this->getUser()->secret)
            ->first();


        // подтверждение e-mail адреса
        if($user->status == 0) {

            if(!is_null($confirmcode) && $user->confirmcode == $confirmcode) {
                $user->status = 1;
            }
        }




        $user->hashtag = $hashtag;
        $user->save();

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }

    public function search($search)
    {
        $user = $this
            ->where('hashtag', $search)
            ->first();


        if(is_null($user)) {
            $result['status'] = 0;
            $result['msg'] = "user with hashtag $search not found";
            return $result;
        }




        $result['status'] = 1;
        $result['msg'] = 'success';
        $result['hashtag'] = $user->hashtag;
        $result['image_id'] = $user->image_id;
        $result['id'] = $user->id;
        return $result;
    }

    public function searchByEmail($email)
    {
        $user = $this
            ->where('email', $email)
            ->first();

        if(is_null($user)) {
            $result['status'] = 0;
            $result['msg'] = "user with email $email not found";
            return $result;
        }

        $result['status'] = 1;
        $result['msg'] = 'user exists';
        return $result;
    }

    public function resetPass($data) {


        $user = $this->find($data['user_id']);
        $user->password = password_hash($data['newpass'], PASSWORD_DEFAULT);
        $user->save();

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;
    }

}
