<?php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\Schema;

echo "=== CURRENT COLUMNS IN USERS TABLE ===\n";
$columns = Schema::getColumnListing('users');
foreach($columns as $column) {
    echo "- {$column}\n";
}
