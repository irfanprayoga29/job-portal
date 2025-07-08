<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add missing profile columns that are in the model but not in previous migrations
            if (!Schema::hasColumn('users', 'about_me')) {
                $table->text('about_me')->nullable();
            }
            if (!Schema::hasColumn('users', 'work_experience')) {
                $table->json('work_experience')->nullable();
            }
            if (!Schema::hasColumn('users', 'education')) {
                $table->json('education')->nullable();
            }
            if (!Schema::hasColumn('users', 'skills')) {
                $table->json('skills')->nullable();
            }
            if (!Schema::hasColumn('users', 'interests')) {
                $table->json('interests')->nullable();
            }
            if (!Schema::hasColumn('users', 'awards')) {
                $table->json('awards')->nullable();
            }
            if (!Schema::hasColumn('users', 'certificates')) {
                $table->json('certificates')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'about_me',
                'work_experience', 
                'education',
                'skills',
                'interests',
                'awards',
                'certificates'
            ]);
        });
    }
};
