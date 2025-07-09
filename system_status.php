<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Application;
use App\Models\Job;
use App\Models\Users;

echo "=== CURRENT SYSTEM STATUS ===\n";
echo "=============================\n\n";

echo "1. COMPANY USERS (Can approve/reject applications):\n";
echo "===================================================\n";
$companies = Users::where('role_id', 2)->get();
foreach ($companies as $company) {
    echo "ID: {$company->id} - {$company->full_name} - {$company->email}\n";
    $jobs = Job::where('user_id', $company->id)->get();
    echo "   Jobs owned: " . $jobs->count() . "\n";
    foreach ($jobs as $job) {
        $appCount = Application::where('job_id', $job->id)->count();
        echo "     - Job {$job->id}: {$job->name} ({$appCount} applications)\n";
    }
    echo "\n";
}

echo "2. APPLICATIONS STATUS:\n";
echo "=======================\n";
$applications = Application::with(['user', 'job'])->get();
foreach ($applications as $app) {
    $status = $app->status ? 'APPROVED' : 'PENDING';
    $buttons = $app->status ? 'NO BUTTONS' : 'APPROVE/REJECT BUTTONS';
    echo "App {$app->id}: {$app->user->full_name} -> {$app->job->name} | Status: {$status} | UI: {$buttons}\n";
}

echo "\n3. TESTING INSTRUCTIONS:\n";
echo "=========================\n";
echo "To test approve/reject buttons:\n";
echo "1. Log in as a company user:\n";
echo "   - Company ID 3 (Test Company User): hr@techcorp.com\n";
echo "   - Company ID 4 (Test Company 2): admin@digitalsol.com\n";
echo "   (Default password: 'password' - check the seeder for exact credentials)\n\n";
echo "2. Navigate to your job applications:\n";
foreach ($companies as $company) {
    $jobs = Job::where('user_id', $company->id)->whereHas('applications')->get();
    foreach ($jobs as $job) {
        echo "   - /superuser/jobs/{$job->id}/applications (Company {$company->id}: {$job->name})\n";
    }
}

echo "\n4. WHAT TO EXPECT:\n";
echo "==================\n";
echo "- Applications with 'Pending Review' status will show Approve/Reject buttons\n";
echo "- Applications with 'Approved' status will show 'Application already approved'\n";
echo "- Only the company that owns the job can see/use the buttons\n";
echo "- Buttons have confirmation dialogs before submission\n";
echo "- Status updates are immediately reflected in the database\n\n";

echo "SYSTEM IS READY FOR TESTING!\n";
