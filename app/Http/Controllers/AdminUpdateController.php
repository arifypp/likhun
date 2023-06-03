<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class AdminUpdateController extends Controller
{
    // AdminUpdateController.php

    public function performUpdate()
    {
        // Put the application into maintenance mode
        Artisan::call('down');

        // Pull the latest code from your GitHub repository
        exec('git pull');

        // Run any required update scripts or commands
        Artisan::call('migrate --force');
        Artisan::call('cache:clear');

        // Disable maintenance mode
        Artisan::call('up');

        // Redirect the admin back to the dashboard or display a success message
        return redirect()->route('admin.dashboard')->with('success', 'Application updated successfully');
    }

}
