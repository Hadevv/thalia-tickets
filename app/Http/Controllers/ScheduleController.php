<?php

namespace App\Http\Controllers;

use App\Helpers\PaginationHelper;
use App\Models\Representation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Helpers\DateHelper;

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

    public function __invoke(Request $request, $date = null)
    {
        try {
            // La date actuelle au format 'YYYY-MM-DD'
            //$currentDay = $request->input('date', now()->toDateString());
            $currentDay = $date ?? now()->toDateString();
            // Jour précédent
            $previousDay = Carbon::parse($currentDay)->subDay()->toDateString();
            // Jour suivant
            $nextDay = Carbon::parse($currentDay)->addDay()->toDateString();
            // Paginer les représentations à venir par jour avec un maximum de représentations par page
            $paginatedRepresentationsByDay = $this->paginateRepresentationsByDay($currentDay, 5);
            // Formater la date actuelle
            $currentDayFormatted = DateHelper::formatScheduleDate($currentDay, 'fr', 'l d F Y');

            return view('schedule.index', compact('paginatedRepresentationsByDay', 'currentDay', 'previousDay', 'nextDay','currentDayFormatted'));
        } catch (\Exception $e) {
            Log::error('Error occurred in ScheduleController: ' . $e->getMessage());
            abort(500, 'Internal Server Error');
        }
    }

    private function paginateRepresentationsByDay($currentDay, $perPage)
    {
        try {
            /**
             * Paginer les représentations à venir par jour avec un maximum de représentations par page.
             * @param string $currentDay
             * @param int $perPage
             * @return array
             */
            $paginatedRepresentations = Representation::with('show', 'location')
                ->whereDate('schedule', $currentDay)
                ->orderBy('schedule')
                ->paginate($perPage);

            // Grouper les représentations par jour en utilisant Carbon pour formater la date
            $groupedRepresentationsByDay = collect($paginatedRepresentations->items())->groupBy(function ($representation) {
                return Carbon::parse($representation->schedule)->format('Y-m-d');
            })->toArray();

            // Paginer chaque groupe de représentations
            foreach ($groupedRepresentationsByDay as $day => $representations) {
                $groupedRepresentationsByDay[$day] = PaginationHelper::paginate(collect($representations), $perPage);
            }

            return $groupedRepresentationsByDay;
        } catch (\Exception $e) {
            Log::error('Error occurred in paginateRepresentationsByDay: ' . $e->getMessage());
            abort(500, 'Internal Server Error');
        }
    }
}


