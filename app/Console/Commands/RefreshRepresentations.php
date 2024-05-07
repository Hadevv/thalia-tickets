<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\HomeController;

class RefreshRepresentations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:refresh-representations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh representations in the home page';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $controller = new HomeController();

        $controller->__invoke();

        $this->info('Representations refreshed successfully.');

    }
}
