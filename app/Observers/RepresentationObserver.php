<?php

namespace App\Observers;

use App\Models\Representation;
use App\Models\RepresentationArchive;

class RepresentationObserver
{
    /**
     * Handle the Representation "created" event.
     */
    public function created(Representation $representation): void
    {


    }

    /**
     * Handle the Representation "updated" event.
     */
    public function updated(Representation $representation): void
    {
        //
    }

    /**
     * Handle the Representation "deleted" event.
     */
    public function deleted(Representation $representation): void
    {
        RepresentationArchive::create($representation->toArray());

    }

    /**
     * Handle the Representation "restored" event.
     */
    public function restored(Representation $representation): void
    {
        //
    }

    /**
     * Handle the Representation "force deleted" event.
     */
    public function forceDeleted(Representation $representation): void
    {
        //
    }
}
