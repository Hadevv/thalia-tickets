<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Representation;
use Carbon\Carbon;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Fonction pour afficher sur la page d'accueil
     * les 5 prochaines représentations
     * @return \Illuminate\Contracts\View\View
     * @throws \Exception
     * @throws \Throwable
     * @todo faire la page schedule et changer les fakes infos
     * @todo faire un tache cron pour supprimer les représentations passées et ne plus est affichées
     */
    public function __invoke() : View
    {
        $today = \Carbon\Carbon::now()->toDateString();

        // Récupération des 5 prochaines représentations
        // /!\ Attention, on récupère les représentations avec les SHOWS associés -> ::with('show')
        $representations = Representation::with('show')
            ->where('schedule', '>=', $today)
            ->orderBy('schedule')
            ->take(5)
            ->get();

        return view('home', compact('representations'));
    }
}
