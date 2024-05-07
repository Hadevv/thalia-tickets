<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Representation;

class CleanupExpiredRepresentations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-expired-representations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete representations older than 7 days';

    /**
     * Execute la tache de la console
     */
    public function handle()
    {
        $this->info('Cleaning up old representations...');

        $representations = Representation::where('schedule', '<', now()->subDays(7))->get();

        foreach ($representations as $representation) {
            // vérifier si la représentation a des réservations associées
            if ($representation->representationReservations->isNotEmpty()) {
                // supprimer les enregistrements associés dans representation_reservation
                $representation->representationReservations()->delete();
            }
            // Supprimer la représentation
            $representation->delete();
        }
        $this->info('Done!');
    }
}

