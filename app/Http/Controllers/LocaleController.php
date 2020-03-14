<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{

    public function set($locale)
    {
        $locale = in_array($locale, config('app.locales')) ? $locale : 'en';

        session(['locale' => $locale]);
        
        return redirect()->back();
    }
}
