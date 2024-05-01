<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    /**
     * Handle the incoming request.
     */

    /**
     * Fonction pour afficher la liste des sièges disponibles pour la réservation
     * @param Request $request
     * @return \Illuminate\View\View
     *
     * @todo le transformer en trait pour la réutilisation dans d'autres contrôleurs de réservation
     * @todo @delete la fonction __invoke ici car pas utilisée
     */
    public function __invoke(Request $request)
    {
        $seats = Seat::where('status', 'available')->orderBy('seat_number')->get();

        return view('representation.booking', compact('seats'));
    }
}
