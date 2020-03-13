<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{

    public function set($locale)
    {
        if (in_array($locale, config('app.locales'))) {
            session(['locale' => $locale]);
        } else {
            session(['locale' => 'en']);
        }
        return redirect()->back();
    }
}
