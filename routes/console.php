<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('custom-chunk:clear', function () {
    $chunksPath = storage_path('app/chunks');

    if (!File::exists($chunksPath)) {
        $this->info('Chunks folder does not exist.');
        return;
    }

    foreach (File::files($chunksPath) as $file) {
        File::delete($file);
    }

    foreach (File::directories($chunksPath) as $directory) {
        File::deleteDirectory($directory);
    }

    $this->info('Chunks folder contents cleared successfully.');
})->purpose('Delete all contents inside storage/app/chunks without removing the chunks folder itself.');

Schedule::command('custom-chunk:clear')->dailyAt('01:00')->timezone('America/New_York');
