<?php
namespace App\Events;

use App\Models\Representation;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class RepresentationCreated
{
    use Dispatchable, SerializesModels;

    public $representation;

    public function __construct(Representation $representation)
    {
        $this->representation = $representation;
    }
}

