<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    /**
     * Fonction pour changer la langue du site et la sauvegarder en session et en base de données après connexion
     * @param $lang
     * @return \Illuminate\Http\RedirectResponse
     * @todo mettre dans url les langues fr/en/nl
     */
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
        // Redirige vers la page précédente
        return redirect()->back();
    }
}
