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
            // Check if columns don't exist before adding
            if (!Schema::hasColumn('users', 'company_logo')) {
                $table->string('company_logo')->nullable();
            }
            if (!Schema::hasColumn('users', 'company_description')) {
                $table->text('company_description')->nullable();
            }
            if (!Schema::hasColumn('users', 'company_website')) {
                $table->string('company_website')->nullable();
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            // address already exists, no need to add
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['company_logo', 'company_description', 'company_website', 'phone']);
        });
    }
};
