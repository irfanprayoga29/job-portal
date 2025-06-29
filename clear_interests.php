<?php

// Simple test script to clear interests
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Users;

// Get the first user (assuming it's the test user)
$user = Users::first();

if ($user) {
    echo "User ID: " . $user->id . "\n";
    echo "User Name: " . $user->full_name . "\n";
    
    echo "Clearing interests...\n";
    
    $user->update(['interests' => []]);
    
    // Refresh and check
    $user->refresh();
    
    echo "After clearing:\n";
    echo "Interests (cast): ";
    var_dump($user->interests);
    echo "\nInterests count: " . ($user->interests ? count($user->interests) : 0) . "\n";
} else {
    echo "No users found\n";
}
