<?php

namespace App\Http\Controllers;

use App\Models\Representation;
use App\Models\Price;
use App\Http\Requests\StoreRepresentationRequest;
use App\Http\Requests\UpdateRepresentationRequest;
use App\Models\Seat;

class RepresentationController extends Controller
{
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

    public function booking(string $id){

        $representation = Representation::find($id);

        $seats = Seat::all();

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
