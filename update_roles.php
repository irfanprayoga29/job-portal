<?php
use Illuminate\Support\Facades\DB;

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\\Contracts\\Console\\Kernel')->bootstrap();

DB::table('roles')->where('id', 1)->update(['name' => 'Applicant']);
DB::table('roles')->where('id', 2)->update(['name' => 'Company']);
echo "Roles updated successfully\n";
