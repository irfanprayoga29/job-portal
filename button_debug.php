<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== COMPREHENSIVE APPROVE/REJECT BUTTON DEBUG ===\n\n";

echo "1. Checking Applications Database:\n";
echo "==================================\n";

$applications = App\Models\Application::with(['user', 'job'])->get();
foreach ($applications as $app) {
    $userName = $app->user ? $app->user->full_name : 'No user';
    $jobName = $app->job ? $app->job->name : 'No job';
    echo "ID: {$app->id} - User: {$userName} - Job: {$jobName} - Status: " . ($app->status ? 'approved' : 'pending') . "\n";
}

echo "\n2. Checking Routes:\n";
echo "==================\n";

try {
    // Try to resolve the approve route
    $approveRoute = app('url')->route('superuser.applications.approve', 3);
    echo "Approve route for app 3: {$approveRoute}\n";
    
    $rejectRoute = app('url')->route('superuser.applications.reject', 3);
    echo "Reject route for app 3: {$rejectRoute}\n";
} catch (Exception $e) {
    echo "Error generating routes: " . $e->getMessage() . "\n";
}

echo "\n3. View Logic Check:\n";
echo "===================\n";

// Simulate the view logic
$pendingApplications = App\Models\Application::where('status', false)->get();
echo "Pending applications (should show buttons): " . $pendingApplications->count() . "\n";
foreach ($pendingApplications as $app) {
    echo "  - App ID {$app->id}: Status = " . ($app->status ? 'true' : 'false') . " (buttons should show)\n";
}

$approvedApplications = App\Models\Application::where('status', true)->get();
echo "Approved applications (should NOT show buttons): " . $approvedApplications->count() . "\n";
foreach ($approvedApplications as $app) {
    echo "  - App ID {$app->id}: Status = " . ($app->status ? 'true' : 'false') . " (buttons should NOT show)\n";
}

echo "\n4. CSS/HTML Check:\n";
echo "==================\n";
echo "Looking for CSS that might hide buttons...\n";

// Check if there are any CSS rules that might hide the buttons
$viewContent = file_get_contents('resources/views/superuser/applications/index.blade.php');
if (strpos($viewContent, 'display: none') !== false) {
    echo "WARNING: Found 'display: none' in the view file!\n";
} else {
    echo "No 'display: none' found in view.\n";
}

if (strpos($viewContent, 'visibility: hidden') !== false) {
    echo "WARNING: Found 'visibility: hidden' in the view file!\n";
} else {
    echo "No 'visibility: hidden' found in view.\n";
}

echo "\n5. Button Condition Check:\n";
echo "=========================\n";

// Check the exact condition used in the view
foreach ($applications as $application) {
    $condition = !$application->status;
    echo "App ID {$application->id}: !status = " . ($condition ? 'true' : 'false') . " (buttons " . ($condition ? 'SHOULD' : 'should NOT') . " show)\n";
}

echo "\nDEBUG COMPLETE!\n";
echo "===============\n";
echo "If buttons are still missing, check:\n";
echo "1. User authentication (must be logged in as company)\n";
echo "2. Browser developer tools for any JavaScript errors\n";
echo "3. Network tab to see if forms are being submitted\n";
echo "4. Check the actual HTML source in browser\n";
