<?php

namespace App\Http\Controllers\Api\User\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Closure;
use App;
use Config;
use Session;

class LocaleController extends Controller
{
    public function setLocale($locale) {

        # Проверяем, что у пользователя выбран доступный язык
        if (in_array($locale, \Config::get('app.locales'))) {
             # И устанавливаем его в сессии под именем locale
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
