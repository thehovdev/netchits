<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{
    public function homePage() {
        if(isset($_COOKIE['auth']) && $_COOKIE['auth'] == 'success') {
            return view("user.profile")
                ->with("username", $_COOKIE['email']);
        } else {
            return view("layouts.start");
        }
    }
}
