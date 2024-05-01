<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representation;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Fonction pour afficher sur la page d'accueil
     * les 5 prochaines représentations
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     * @todo faire la page schedule et changer les fakes infos
     */
    public function __invoke()
    {
        $today = \Carbon\Carbon::now()->toDateString();

        $representations = \App\Models\Representation::where('schedule', '>=', $today)
            ->orderBy('schedule')
            ->take(5)
            ->get();

        return view('home', compact('representations'));
    }
}
