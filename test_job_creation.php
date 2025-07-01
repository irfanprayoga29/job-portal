<?php

// Test script to verify the migration worked
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Testing Database Schema ===\n";

// Check the current schema of the jobs table
$columns = DB::select("DESCRIBE jobs");

foreach ($columns as $column) {
    if ($column->Field === 'date_uploaded') {
        echo "Column: {$column->Field}\n";
        echo "Type: {$column->Type}\n";
        echo "Null: {$column->Null}\n";
        echo "Default: {$column->Default}\n";
        echo "Extra: {$column->Extra}\n";
        break;
    }
}

echo "\n=== Testing Job Creation Without date_uploaded ===\n";

try {
    // Test creating a job without specifying date_uploaded
    $testData = [
        'name' => 'Test Job',
        'location' => 'Test Location',
        'salary' => 50000,
        'description' => 'Test Description',
        'requirements' => 'Test Requirements',
        'employment_type' => 'Full-time',
        'experience_level' => 'Mid Level',
        'status' => true,
        'user_id' => 1
    ];
    
    DB::table('jobs')->insert($testData);
    echo "✓ Job creation successful without explicit date_uploaded\n";
    
    // Get the last inserted job
    $lastJob = DB::table('jobs')->orderBy('id', 'desc')->first();
    echo "Last job date_uploaded: {$lastJob->date_uploaded}\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
