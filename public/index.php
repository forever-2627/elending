<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    (require_once __DIR__.'/../bootstrap/app.php')
        ->handleRequest(Request::capture());
} catch (\Exception $e) {
    // Display a custom error message
    echo "<h1>An error occurred</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";

    // Optionally, log the exception to Laravel's log file
    // (requires that the logger is properly initialized)
    file_put_contents(__DIR__.'/../storage/logs/laravel.log', $e->getMessage()."\n", FILE_APPEND);
}


