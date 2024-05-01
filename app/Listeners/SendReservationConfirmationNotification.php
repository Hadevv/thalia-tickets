<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ReservationConfirmed;

class SendReservationConfirmationNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Fonction pour envoyer une notification de confirmation de réservation à l'utilisateur
     */
    public function handle(ReservationConfirmed $event): void
    {
        // Notification : Envoyer un email de confirmation de réservation
        $event->reservation->user->notify(new \App\Notifications\ReservationConfirmedNotification());

    }
}
