<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // First, change column type to string
            $table->string('status', 20)->default('pending')->change();
        });
        
        // Then update existing boolean values to string equivalents
        DB::statement("UPDATE applications SET status = 'accepted' WHERE status = '1'");
        DB::statement("UPDATE applications SET status = 'pending' WHERE status = '0'");
        
        // Finally, change to enum
        Schema::table('applications', function (Blueprint $table) {
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            // Convert back to boolean
            DB::statement("UPDATE applications SET status = 1 WHERE status = 'accepted'");
            DB::statement("UPDATE applications SET status = 0 WHERE status IN ('pending', 'declined')");
            
            $table->boolean('status')->default(false)->change();
        });
    }
};
