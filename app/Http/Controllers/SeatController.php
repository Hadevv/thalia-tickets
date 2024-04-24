<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seat;

class SeatController extends Controller
{
    /**
     * Handle the incoming request.
     */

    // Pas utilisé deplacé dans RepresentationController
    public function __invoke(Request $request)
    {
        $seats = Seat::where('status', 'available')->orderBy('seat_number')->get();

        return view('representation.booking', compact('seats'));
    }
}
