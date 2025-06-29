<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Resume;
use App\Models\Users;

$user = Users::where('role_id', 1)->first();
if ($user) {
    $filePath = public_path('uploads/resumes/test_resume.txt');
    Resume::create([
        'user_id' => $user->id,
        'title' => 'Software Developer Resume',
        'description' => 'My professional resume for software development positions',
        'file_name' => 'test_resume.txt',
        'file_path' => 'uploads/resumes/test_resume.txt',
        'file_type' => 'text/plain',
        'file_size' => file_exists($filePath) ? filesize($filePath) : 1024,
        'is_active' => true
    ]);
    echo "Test resume created successfully\n";
} else {
    echo "No test user found\n";
}
