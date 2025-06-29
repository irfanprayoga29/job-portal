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
        Schema::table('resumes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->string('file_name')->after('user_id');
            $table->string('file_path')->after('file_name');
            $table->string('file_type')->after('file_path');
            $table->integer('file_size')->after('file_type'); // in bytes
            $table->boolean('is_active')->default(true)->after('description');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resumes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'file_name', 'file_path', 'file_type', 'file_size', 'is_active']);
        });
    }
};
