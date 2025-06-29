<?php
// Quick test script to check profile page
require 'vendor/autoload.php';

use App\Models\Users;

// Get first user
$user = Users::first();

if (!$user) {
    echo "No users found";
    exit;
}

echo "User found: " . $user->full_name . "\n";
echo "Email: " . $user->email . "\n";
echo "Work Experience: " . json_encode($user->work_experience) . "\n";
echo "Education: " . json_encode($user->education) . "\n";
echo "Skills: " . json_encode($user->skills) . "\n";

?>
