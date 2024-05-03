<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function __invoke(Request $request)
    {
        // Paginer les représentations à venir par jour avec un maximum de représentations par page
        $paginatedRepresentationsByDay = $this->paginateRepresentationsByDay(5);

        return view('schedule.index', compact('paginatedRepresentationsByDay'));
    }

    /**
     * Paginer les représentations à venir par jour avec un maximum de représentations par page
     *
     * @param int $perPage
     * @return array
     */
    private function paginateRepresentationsByDay($perPage)
    {
        $paginatedRepresentationsByDay = [];

        // Récupérer les représentations à venir paginées par jour avec un maximum de représentations par page
        /**
        $representationsByDay = DB::table('representations')
            ->join('shows', 'representations.show_id', '=', 'shows.id')
            ->selectRaw('DATE(schedule) as day, representations.*, shows.title as show_title, shows.location_id as show_location_id')
            ->where('schedule', '>=', now()->toDateTimeString())
            ->orderBy('schedule')
            ->paginate($perPage);
         * */

        $representationsByDay = Representation::with('show')
            ->selectRaw('DATE(schedule) as day')
            ->where('schedule', '>=', now()->toDateTimeString())
            ->orderBy('schedule')
            ->paginate($perPage);


        // Organiser les représentations paginées par jour
        foreach ($representationsByDay as $representation) {
            $day = $representation->day;

            if (!isset($paginatedRepresentationsByDay[$day])) {
                $paginatedRepresentationsByDay[$day] = [];
            }

            $paginatedRepresentationsByDay[$day][] = $representation;
        }

        return $paginatedRepresentationsByDay;
    }
}

