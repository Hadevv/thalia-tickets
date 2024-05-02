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
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cleaning up old representations...');

        $representations = Representation::where('schedule', '<', now()->subDays(7))->get();


        foreach ($representations as $representation) {
            $representation->delete();
        }

        $this->info('Done!');
    }
}
