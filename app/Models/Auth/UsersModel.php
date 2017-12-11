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

        $checkUser = $this->where([
            ['email', '=', $email],
        ])->first();


        // -----------------RESULT ----------------//
        if(!is_null($checkUser)) {
            $this->result['status'] = 0;
            $this->result['msg'] = "user with this $email already exists";
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
        $this->result['email'] = $email;

        return $this->result;
        // -----------------RESULT ----------------//

    }



    public function addUser($usersData) {

        $this->email = $usersData['email'];
        $this->password = $usersData['password'];
        $this->save();

        $this->result['status'] = 1;
        $this->result['msg'] = 'success';
        $this->result['email'] = $usersData['email'];

        return $this->result;
    }
}
