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
        Schema::create('package_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')->constrained('packages_refactored')->onDelete('cascade');
            $table->string('locale', 5); // 'en', 'ar'
            $table->string('title');
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->json('itinerary')->nullable(); // Day-by-day structure
            $table->json('inclusions')->nullable(); // List of included features
            $table->json('exclusions')->nullable(); // List of excluded features
            $table->text('terms_and_conditions')->nullable();
            $table->timestamps();

            $table->unique(['package_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_translations');
    }
};
