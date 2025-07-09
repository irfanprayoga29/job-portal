<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Application;
use App\Models\Job;
use App\Models\Users;

echo "Creating test applications...\n";

// Get some jobs and users
$jobs = Job::take(3)->get();
$applicants = Users::where('role_id', 1)->take(2)->get(); // Get regular users (applicants)

if ($jobs->count() == 0 || $applicants->count() == 0) {
    echo "No jobs or applicants found. Make sure seeders have been run.\n";
    exit;
}

$applicationCount = 0;

foreach ($jobs as $job) {
    foreach ($applicants as $applicant) {
        // Create application
        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => $applicant->id,
            'date_submitted' => now(),
            'status' => false, // pending
            'cover_letter' => "Dear Hiring Manager,\n\nI am very interested in the " . $job->name . " position. I believe my skills and experience make me a great fit for this role.\n\nBest regards,\n" . $applicant->full_name
        ]);
        
        echo "Created application {$application->id}: {$applicant->full_name} -> {$job->name} (Job Owner: {$job->user_id})\n";
        $applicationCount++;
    }
}

echo "\nCreated {$applicationCount} test applications!\n";
echo "All applications are set to pending status (false) so approve/reject buttons should appear.\n";
