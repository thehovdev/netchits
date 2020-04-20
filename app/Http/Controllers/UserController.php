<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Services\ImageUpload;

class UserController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth', ['except' => 'continue']);
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

    public function apply(Request $request)
    {
        $user = auth()->user();
        $validated = $request->validate([
            'name' => 'required',
            'hashtag' => 'required',
            'email' => 'required|email',
            'current_password' => ['nullable', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail(__('Incorrent current password'));
                }
            }],
            'password' => 'required_with:current_password|confirmed'
        ]);
        
        if ($validated->passes()) {
            $user->fill([
                'name' => $request->name,
                'hashtag' => $request->hashtag,
                'email' => $request->email,
                'password' => !is_null($request->password) ? Hash::make($request->password) : $user->password
            ])->save();

            session(['message' => 'Successfully updated the profile']);
            
            return redirect()->back();
        }

        return redirect()->back()->withErrors($validated);
    }

    public function continue(User $user, Faker $faker)
    {
        $user->fill([
            'name' => $faker->name,
            'hashtag' => '#guest' . time(),
            'email' => $faker->email,
            'email_verified_at' => now(),
            'password' => Hash::make($faker->password)
        ])->save();

        Auth::login($user);
        
        return redirect()->route('home');
    }
}
