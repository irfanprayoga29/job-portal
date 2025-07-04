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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->text('address');

            $table->unsignedBigInteger('resume_id')->nullable();
            $table->unsignedBigInteger('role_id');

            $table->foreign('resume_id')->references('id')->on('resumes');
            $table->foreign('role_id')->references('id')->on('roles');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
