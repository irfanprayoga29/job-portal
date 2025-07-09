<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== AUTHENTICATION STATUS CHECK ===\n\n";

// Check if we can access Auth
try {
    $isAuthenticated = Auth::check();
    echo "Is authenticated: " . ($isAuthenticated ? 'YES' : 'NO') . "\n";
    
    if ($isAuthenticated) {
        $user = Auth::user();
        echo "User ID: " . $user->id . "\n";
        echo "User name: " . $user->full_name . "\n";
        echo "User role ID: " . $user->role_id . "\n";
        echo "Is company user: " . ($user->role_id == 2 ? 'YES' : 'NO') . "\n";
    }
} catch (Exception $e) {
    echo "Error checking auth: " . $e->getMessage() . "\n";
    echo "This is normal when running from CLI - auth requires web session\n";
}

echo "\n=== COMPANY USERS IN DATABASE ===\n";

use App\Models\Users;
use App\Models\Job;

$companyUsers = Users::where('role_id', 2)->get();
echo "Found " . $companyUsers->count() . " company users:\n";
foreach ($companyUsers as $user) {
    echo "ID: {$user->id} - {$user->full_name} - {$user->email}\n";
    
    // Check which jobs this company owns
    $jobs = Job::where('user_id', $user->id)->get();
    echo "  Jobs owned: " . $jobs->count() . "\n";
    foreach ($jobs as $job) {
        $appCount = $job->applications()->count();
        echo "    - Job {$job->id}: {$job->name} ({$appCount} applications)\n";
    }
}

echo "\n=== RECOMMENDATION ===\n";
echo "To see the approve/reject buttons:\n";
echo "1. Make sure you're logged in to the website as a company user\n";
echo "2. Navigate to a job's applications page that you own\n";
echo "3. Look for applications with 'Pending Review' status\n";
echo "4. Only those will show approve/reject buttons\n";
