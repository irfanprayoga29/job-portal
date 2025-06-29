<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Users;

echo "=== TEST USERS (Applicants) ===\n";
$users = Users::where('role_id', 1)->get(['username', 'full_name', 'role_id']);
foreach($users as $user) {
    echo "Username: {$user->username} | Name: {$user->full_name} | Role: {$user->role_id}\n";
}

echo "\n=== TEST USERS (Companies) ===\n";
$companies = Users::where('role_id', 2)->get(['username', 'full_name', 'role_id']);
foreach($companies as $company) {
    echo "Username: {$company->username} | Name: {$company->full_name} | Role: {$company->role_id}\n";
}
