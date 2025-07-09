<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    echo "Testing with correct application ID 3...\n";
    
    $application = App\Models\Application::find(3);
    
    if (!$application) {
        echo "Application 3 not found!\n";
        exit;
    }
    
    echo "Application found!\n";
    echo "Application ID: {$application->id}\n";
    echo "Current Status: " . ($application->status ? 'true' : 'false') . "\n";
    echo "Job ID: {$application->job_id}\n";
    echo "User ID: {$application->user_id}\n";
    
    // Check job details
    if ($application->job) {
        echo "Job Title: {$application->job->name}\n";
        echo "Job Company ID: {$application->job->company_id}\n";
    } else {
        echo "Job not found for this application!\n";
    }
    
    // Test update
    echo "\nTesting status update...\n";
    $oldStatus = $application->status;
    echo "Old status: " . ($oldStatus ? 'true' : 'false') . "\n";
    
    $application->status = true;
    $saved = $application->save();
    echo "Save result: " . ($saved ? 'success' : 'failed') . "\n";
    
    $fresh = $application->fresh();
    echo "New status: " . ($fresh->status ? 'true' : 'false') . "\n";
    
    if ($fresh->status) {
        echo "SUCCESS: Status was updated correctly!\n";
    } else {
        echo "FAILED: Status was not updated!\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
