<?php

namespace App\Listeners;

use App\Events\RepresentationCreated;
use App\Models\Seat;
use App\Models\RepresentationSeat;

class CreateSeatsForRepresentation
{
    public function handle(RepresentationCreated $event)
    {
        $representation = $event->representation;

        // les sieges par defaut
        $defaultSeats = Seat::all();

        // assosier les sieges par defaut a la representation
        foreach ($defaultSeats as $seat) {
            RepresentationSeat::create([
                'representation_id' => $representation->id,
                'seat_id' => $seat->id,
            ]);
        }
    }
}
