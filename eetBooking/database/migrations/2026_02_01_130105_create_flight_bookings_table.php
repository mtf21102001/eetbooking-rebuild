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
        Schema::create('flight_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->nullable()->constrained('users');

            // Contact Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            // Flight Details
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->date('departure_date');
            $table->date('return_date')->nullable();
            $table->integer('adults')->default(1);
            $table->integer('children')->default(0);
            $table->integer('infants')->default(0);
            $table->string('class_preference')->default('economy'); // economy, business, first

            $table->string('status')->default('pending'); // pending, confirmed, cancelled
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_bookings');
    }
};
