<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use App\Models\Price;
use App\Http\Requests\StoreRepresentationRequest;
use App\Http\Requests\UpdateRepresentationRequest;
use App\Models\Seat;

class RepresentationController extends Controller
{
    /**
     * Fonction pour afficher la liste des représentations à venir triées par date
     * @return \Illuminate\View\View
     * @todo Ajouter la pagination pour la liste des représentations
     */
    public function show(string $id)
    {
        $representation = Representation::find($id);

        if (is_string($representation->schedule)) {
            $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
        }

        return view('representation.show', [
            'representation' => $representation,
        ]);
    }

    /**
     * Fonction pour afficher la page de choix des places pour la réservation et les sièges disponibles avant de passer à la réservation (checkout)
     * @param string $id
     * @return \Illuminate\View\View
     * @todo Ajouter la vérification de la date de la représentation pour la réservation
     */
    public function booking(string $id)
    {

        $representation = Representation::find($id);

        $seats = Seat::all();

        // @todo delete Carbon\Carbon::parse dans le controller soit model ou dans la vue
        if (is_string($representation->schedule)) {
            $representation->schedule = \Carbon\Carbon::parse($representation->schedule);
        }

        $currentPrices = Price::where('end_date', '=', null)->get();

        return view('representation.booking', [
            'representation' => $representation,
            'currentPrices' => $currentPrices,
            'seats' => $seats,
        ]);
    }
}
