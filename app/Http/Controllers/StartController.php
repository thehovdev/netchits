<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StartController extends Controller
{
    public function homePage() {
        return view("layouts.start");
    }
}
