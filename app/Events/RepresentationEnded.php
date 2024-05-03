<?php

namespace App\Events;

use App\Models\Representation;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RepresentationEnded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    // Event pour déclencher la modale reviews
    public $representation;
    public function __construct(Representation $representation)
    {
        $this->representation = $representation;
    }

    /**
     * Channel pour les events en temps réel pas utilisé ici
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
