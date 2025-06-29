<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;

class TestCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test company user
        Users::create([
            'full_name' => 'Tech Corp Indonesia',
            'username' => 'techcorp',
            'email' => 'hr@techcorp.com',
            'password' => Hash::make('company123'),
            'date_of_birth' => '2010-01-01',
            'gender' => 'Private',
            'address' => 'Jl. Sudirman No. 123, Jakarta',
            'role_id' => 2, // Company role
        ]);

        // Create another test company
        Users::create([
            'full_name' => 'Digital Solutions Ltd',
            'username' => 'digitalsol',
            'email' => 'admin@digitalsol.com',
            'password' => Hash::make('admin123'),
            'date_of_birth' => '2015-05-15',
            'gender' => 'Startup',
            'address' => 'Jl. Gatot Subroto No. 456, Jakarta',
            'role_id' => 2, // Company role
        ]);
    }
}
