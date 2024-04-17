<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function setLocale($lang)
    {
        if (in_array($lang, ['fr', 'en', 'nl'])) {
            App::setLocale($lang);
            session(['locale' => $lang]);

            if (auth()->check()) {
                $user = User::find(auth()->id());
                $user->langue = $lang;
                $user->save();
            }
        }
        return redirect()->back();
    }
}
