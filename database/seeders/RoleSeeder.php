<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if roles already exist to avoid duplicate entries
        if (DB::table('roles')->count() == 0) {
            DB::table('roles')->insert([
                ['id' => 1, 'name' => 'Applicant', 'created_at' => now(), 'updated_at' => now()],
                ['id' => 2, 'name' => 'Company', 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
