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
        Schema::table('bookings', function (Blueprint $table) {

            if (!Schema::hasColumn('bookings', 'package_id')) {
                $table->foreignId('package_id')->nullable()->constrained('packages_refactored')->cascadeOnDelete();
            }
            if (!Schema::hasColumn('bookings', 'customer_name')) {
                $table->string('customer_name')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'customer_email')) {
                $table->string('customer_email')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'customer_phone')) {
                $table->string('customer_phone')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'travel_date')) {
                $table->date('travel_date')->nullable();
            }
            if (!Schema::hasColumn('bookings', 'number_of_travelers')) {
                $table->integer('number_of_travelers')->default(1);
            }
            if (!Schema::hasColumn('bookings', 'notes')) {
                $table->text('notes')->nullable();
            }

            // Fix user_id nullable if not already
            // We can't easily check nullability in varying drivers with Schema builder, 
            // but we can just blindly change it to nullable.
            $table->foreignId('user_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
