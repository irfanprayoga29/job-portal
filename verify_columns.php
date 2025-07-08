<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';

// Test just the schema check without booting the full app
use Illuminate\Support\Facades\Schema;

// Basic connection test
try {
    echo "Testing database columns in users table:" . PHP_EOL;
    echo "✓ Company name: " . (Schema::hasColumn('users', 'company_name') ? 'EXISTS' : 'MISSING') . PHP_EOL;
    echo "✓ Company logo: " . (Schema::hasColumn('users', 'company_logo') ? 'EXISTS' : 'MISSING') . PHP_EOL;  
    echo "✓ Company description: " . (Schema::hasColumn('users', 'company_description') ? 'EXISTS' : 'MISSING') . PHP_EOL;
    echo "✓ About me: " . (Schema::hasColumn('users', 'about_me') ? 'EXISTS' : 'MISSING') . PHP_EOL;
    echo "✓ Skills: " . (Schema::hasColumn('users', 'skills') ? 'EXISTS' : 'MISSING') . PHP_EOL;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}
