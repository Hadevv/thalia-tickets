<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Fonction pour afficher la liste des représentations à venir triées par date dans une page dédiée
     * @param Request $request
     * @return \Illuminate\View\View
     * @todo utiliser l'observer pour le rafraichissement automatique de la page pour les représentations à venir dans le futur proche (5 minutes) via task scheduler (cron job)
     * @todo Ajouter la pagination pour la liste des représentations horaires
     * @todo utiliser une lib de planning par jour avec swiper pour la navigation entre les jours de la semaine
     */
    public function __invoke(Request $request): \Illuminate\View\View
    {
        $upcomingRepresentations = Representation::where('schedule', '>=', now())
            ->orderBy('schedule')
            ->get();

        return view('schedule.index', compact('upcomingRepresentations'));
    }
}
