<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app->withExceptions(function (Exceptions $exceptions) {
    //
})->withMiddleware(function (Middleware $middleware) {
    //
});

$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Application;
use App\Models\Job;

echo "Checking applications...\n";

try {
    $applications = Application::with(['user', 'job'])->get();
    
    echo "Found " . $applications->count() . " applications\n";
    
    foreach ($applications as $app) {
        echo "App ID: " . $app->id . " - User: " . $app->user->full_name . " - Job: " . $app->job->name . " - Status: " . ($app->status ? 'approved' : 'pending') . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
