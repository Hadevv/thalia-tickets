<?php

namespace App\Traits;

use App\Models\RepresentationSeat;

trait HasAvailableSeats
{
    public function getAvailableSeatsCount($representationId)
    {
        return RepresentationSeat::where('representation_id', $representationId)
            ->where('status', 'available') // verifier si le status est disponible
            ->count();
    }
}
