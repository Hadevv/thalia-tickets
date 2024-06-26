<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class ReservationConfirmed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Reservation $reservation;
    // Event sans temps réel pour confirmer la réservation
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
    /**
     * Event en temps réel Broadcasting pour confirmer la réservation
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
