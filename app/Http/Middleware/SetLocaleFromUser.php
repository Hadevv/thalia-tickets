<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetLocaleFromUser
{
    public function handle($request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        } elseif (Auth::check()) {
            $user = Auth::user();
            if (in_array($user->langue, ['fr', 'en', 'nl'])) {
                App::setLocale($user->langue);
                session(['locale' => $user->langue]);
            } else {
                App::setLocale('fr');
                session(['locale' => 'fr']);
            }
        } else {
            App::setLocale('fr');
            session(['locale' => 'fr']);
        }

        return $next($request);
    }
}
