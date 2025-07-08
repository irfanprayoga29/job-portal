<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$app->boot();

use App\Models\Users;

// Test the model
$user = new Users();
echo "Testing Users model..." . PHP_EOL;
echo "Fillable fields: " . implode(', ', $user->getFillable()) . PHP_EOL;

// Test database connection and check if company_name column exists
try {
    $hasCompanyName = \Illuminate\Support\Facades\Schema::hasColumn('users', 'company_name');
    echo "Company name column exists: " . ($hasCompanyName ? 'YES' : 'NO') . PHP_EOL;
    
    $hasCompanyLogo = \Illuminate\Support\Facades\Schema::hasColumn('users', 'company_logo');
    echo "Company logo column exists: " . ($hasCompanyLogo ? 'YES' : 'NO') . PHP_EOL;
    
    $hasAboutMe = \Illuminate\Support\Facades\Schema::hasColumn('users', 'about_me');
    echo "About me column exists: " . ($hasAboutMe ? 'YES' : 'NO') . PHP_EOL;
    
} catch (Exception $e) {
    echo "Error checking columns: " . $e->getMessage() . PHP_EOL;
}

echo "Test completed." . PHP_EOL;
