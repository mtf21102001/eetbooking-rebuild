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
        Schema::create('visa_applications', function (Blueprint $table) {
            $table->id();
            $table->string('application_reference')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('visa_id')->constrained('visas');
            $table->foreignId('nationality_id')->constrained('nationalities');

            // Personal Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            // Travel Info
            $table->string('passport_number');
            $table->date('passport_expiry');
            $table->string('occupation')->nullable();
            $table->integer('monthly_income')->nullable();

            $table->string('status')->default('pending'); // pending, approved, denied, processing
            $table->text('admin_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_applications');
    }
};
