<?php

namespace App\Observers;

use App\Models\Representation;
use App\Models\RepresentationArchive;
use App\Events\RepresentationEnded;

class RepresentationObserver
{
    /**
     * Vérifie si la date de la representation est passée et si c'est le cas, envoie un event pour la fin de la representation
     */
    public function updated(Representation $representation): void
    {
        if ($representation->isDirty('schedule') && $representation->schedule < now()) {
            event(new RepresentationEnded($representation));
        }
    }
    /**
     * Suppression d'une representation dans la table representation et l'ajout dans la table representation_archive
     */
    public function deleted(Representation $representation): void
    {
        RepresentationArchive::create($representation->toArray());
    }

    /**
     * Handle the Representation "created" event.
     */
    public function created(Representation $representation): void
    {
        //
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
