<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    protected $listen = [
        'App\Events\ReservationConfirmed' => [
            'App\Listeners\SendReservationConfirmationNotification',
        ],
        'App\Events\RepresentationEnded' => [
            'App\Listeners\HandleRepresentationEnded',
        ],
    ];

    /**
     * Fonction de démarrage des services de l'application
     */
    public function boot(): void
    {
        parent::boot();
    }
}

