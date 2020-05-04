<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class FollowerController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    
    public function follow(Request $request)
    {
        $user = User::find($request->id);
        auth()->user()->follow($user);
        
        return response()->json([
            'id' => $user->id,
            'msg' => 'Success'
        ]);
    }

    public function unfollow(Request $request)
    {
        $user = User::find($request->id);
        auth()->user()->unfollow($user);

        return response()->json([
            'id' => $user->id,
            'msg' => 'Success'
        ]);
    }
}
