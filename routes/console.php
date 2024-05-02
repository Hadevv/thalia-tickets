<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CleanupExpiredRepresentations;
use App\Console\Commands\RefreshRepresentations;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Tache cron pour cleanup des représentations
Schedule::command(CleanupExpiredRepresentations::class)->daily();

// Tache cron pour refresh des représentations
Schedule::command(RefreshRepresentations::class)->everyFiveMinutes();



