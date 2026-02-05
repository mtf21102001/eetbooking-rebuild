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
    Schema::table('packages_refactored', function (Blueprint $table) {
      // Distance from city center or airport (in km)
      $table->decimal('distance_from_center', 8, 2)->nullable()->after('duration_days');

      // Capacity limits
      $table->integer('min_people')->default(1)->after('distance_from_center');
      $table->integer('max_people')->nullable()->after('min_people');

      // Difficulty level (Easy, Moderate, Challenging)
      $table->string('difficulty_level')->nullable()->after('max_people');

      // Best season to visit (Winter, Spring, Summer, Fall, Year-round)
      $table->string('best_season')->nullable()->after('difficulty_level');

      // Discount percentage (for offers)
      $table->decimal('discount_percentage', 5, 2)->nullable()->after('offer_tag');
      $table->decimal('original_price', 10, 2)->nullable()->after('discount_percentage');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('packages_refactored', function (Blueprint $table) {
      $table->dropColumn([
        'distance_from_center',
        'min_people',
        'max_people',
        'difficulty_level',
        'best_season',
        'discount_percentage',
        'original_price',
      ]);
    });
  }
};
