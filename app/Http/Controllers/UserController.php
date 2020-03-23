<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;

use App\Services\ImageUpload;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function settings()
    {
        return view('settings')->with('user', auth()->user());
    }

    public function upload(Request $request)
    {
        $user = auth()->user();
        $image = new ImageUpload($request->file('image'));
        $fileNameToStore = $image->getFileName() . '_' . time() . '.' . $image->getFileExtension();
        $path = public_path('images');

        $image->upload($path, $fileNameToStore);
        
        $user->profile_picture = $fileNameToStore;

        $user->save();

        return redirect()->back();

    }

    }
}
