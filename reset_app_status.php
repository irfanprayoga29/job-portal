<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Resetting application 3 status to pending (false)...\n";

$application = App\Models\Application::find(3);
if ($application) {
    $application->status = false;
    $application->save();
    echo "Application 3 status reset to pending!\n";
    echo "Current status: " . ($application->fresh()->status ? 'approved' : 'pending') . "\n";
} else {
    echo "Application 3 not found!\n";
}

// Let's also check all applications
echo "\nAll applications:\n";
$applications = App\Models\Application::with(['user', 'job'])->get();
foreach ($applications as $app) {
    $userName = $app->user ? $app->user->full_name : 'No user';
    $jobName = $app->job ? $app->job->name : 'No job';
    echo "ID: {$app->id} - User: {$userName} - Job: {$jobName} - Status: " . ($app->status ? 'approved' : 'pending') . "\n";
}
