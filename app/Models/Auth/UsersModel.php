<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    protected $guarded = ['id'];
    public $timestamps = false;
    public $result = [];

    public function checkSignUp($protectedData) {
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


    public function checkSignIn($userData) {
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



    public function addUser($usersData) {

        // insert to database
        $this->email = $usersData['email'];
        $this->hashtag = $usersData['hashtag'];
        $this->password = $usersData['password'];
        $this->secret = $usersData['secret'];
        $this->save();

        // return result
        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        $this->result['email'] = $usersData['email'];
        $this->result['secret'] = $usersData['secret'];

        return $this->result;
    }

    public function getUser() {

        $email = $_COOKIE['email'];
        $secret = $_COOKIE['secret'];

        $user = $this->where([
            ['email', '=', $email],
            ['secret', '=', $secret]
        ])->first();

        return $user;
    }

    public function updateImage($image_id) {

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

    public function hashtagUpdate($hashtag) {
        if(is_null($hashtag)) {
            $result['status'] = 0;
            $result['msg'] = 'hashtag id not be empty';
            return $result;
        }

        $user = $this
            ->where('email', $this->getUser()->email)
            ->where('secret', $this->getUser()->secret)
            ->first();

        $user->hashtag = $hashtag;
        $user->save();

        $result['status'] = 1;
        $result['msg'] = 'success';
        return $result;

    }

}
