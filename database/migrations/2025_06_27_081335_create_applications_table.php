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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->date('date_submitted');
            $table->boolean('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('job_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('job_id')->references('id')->on('jobs');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
