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
        Schema::table('jobs', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->text('requirements')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('experience_level')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn(['description', 'requirements', 'employment_type', 'experience_level']);
        });
    }
};
