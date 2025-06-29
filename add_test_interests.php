<?php

// Simple test script to manually add interests
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Users;

// Get the first user (assuming it's the test user)
$user = Users::first();

if ($user) {
    echo "User ID: " . $user->id . "\n";
    echo "User Name: " . $user->full_name . "\n";
    
    // Manually set some test interests
    $testInterests = ['Technology', 'Remote Work', 'Innovation', 'Data Science'];
    
    echo "Setting test interests: " . implode(', ', $testInterests) . "\n";
    
    $user->update(['interests' => $testInterests]);
    
    // Refresh and check
    $user->refresh();
    
    echo "After update:\n";
    echo "Raw interests field: " . $user->getAttributes()['interests'] . "\n";
    echo "Interests (cast): ";
    var_dump($user->interests);
    echo "\nInterests count: " . ($user->interests ? count($user->interests) : 0) . "\n";
    
    if ($user->interests && count($user->interests) > 0) {
        echo "Individual interests:\n";
        foreach ($user->interests as $index => $interest) {
            echo "  [$index]: $interest\n";
        }
    } else {
        echo "Still no interests found\n";
    }
} else {
    echo "No users found\n";
}
