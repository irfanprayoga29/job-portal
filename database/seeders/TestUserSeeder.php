<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test useraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa      
        Users::create([
            'full_name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
            'date_of_birth' => '1990-01-01',
            'gender' => 'Male',
            'address' => 'Test Address',
            'role_id' => 1,
        ]);

        // Create another test user
        Users::create([
            'full_name' => 'Applicant 2 User',
            'username' => 'applicant2',
            'email' => 'applicant2@example.com',
            'password' => Hash::make('applicant123'),
            'date_of_birth' => '1985-05-15',
            'gender' => 'Female',
            'address' => 'Admin Address',
            'role_id' => 1,
        ]);
    }
}
