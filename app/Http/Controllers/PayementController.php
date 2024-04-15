<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;


class PayementController extends Controller
{
    public function checkout(Request $request, Reservation $reservation)
    {
        $user = $request->user();

        $user->invoiceFor('Réservation', $reservation->total(), [], [
            'metadata' => ['reservation_id' => $reservation->id],
        ]);

        return redirect()->route('reservation.confirmation', ['id' => $reservation->id])
            ->with('success', 'Votre réservation a été confirmée avec succès.');
    }

}
