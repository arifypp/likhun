<?php

use App\Models\UpdateVersion;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// routes/console.php

Artisan::command('check-updates', function () {
    $githubToken = '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';
    $username = 'arifypp';
    $repository = 'likhun';

    $latestRelease = Http::withHeaders([
        'Authorization' => 'Bearer ' . $githubToken,
        'Accept' => 'application/vnd.github.v3+json',
    ])->get("https://api.github.com/repos/{$username}/{$repository}/commits/main")->json();

    if (isset($latestRelease['sha'])) {
        $latestVersion = substr($latestRelease['sha'], 0, 7);
        $currentVersion = Config::get('app.version');

        if ($latestVersion !== $currentVersion) {
            // Store the update information in the database or create a notification for the admin dashboard
            // Example: UpdateVersion model with a version and release notes field
            UpdateVersion::create([
                'version' => $latestVersion,
                'release_notes' => $latestRelease['commit']['message'],
            ]);

            $this->info('A new update is available. Please run the update command.');
        } else {
            $this->info('No updates available.');
        }
    } else {
        $this->error('Failed to fetch update information.');
    }
})->describe('Check for application updates');