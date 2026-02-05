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
        Schema::create('packages_refactored', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->nullable(); // No constraint - categories table doesn't exist yet
            $table->foreignId('destination_id')->nullable()->constrained('destinations')->onDelete('set null');
            $table->decimal('price', 10, 2);
            $table->string('type')->nullable()->index(); // For dynamic filtering (Cultural, Luxury, etc.)
            $table->string('currency', 3)->default('USD');
            $table->integer('duration_days');

            // Homepage Sections Fields
            $table->boolean('is_offer')->default(false);
            $table->string('offer_tag')->nullable(); // Best Seller, Trending, etc.
            $table->boolean('is_popular')->default(false);
            $table->decimal('rating', 3, 2)->default(5.00);

            $table->boolean('featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages_refactored');
    }
};
