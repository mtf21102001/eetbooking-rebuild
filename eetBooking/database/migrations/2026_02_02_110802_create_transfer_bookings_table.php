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
        Schema::create('transfer_bookings', function (Blueprint $table) {
            $table->id();
            $table->string('booking_reference')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

            // Customer Info
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');

            // Trip Info
            $table->string('pickup_location');
            $table->string('dropoff_location');
            $table->date('pickup_date');
            $table->time('pickup_time')->nullable();

            $table->integer('passengers')->default(1);
            $table->string('vehicle_type')->nullable(); // Sedan, Van, Bus, etc.

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
        Schema::dropIfExists('transfer_bookings');
    }
};
