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
    Schema::create('destinations', function (Blueprint $table) {
      $table->id();
      $table->foreignId('city_id')->constrained()->cascadeOnDelete();
      $table->string('name_en');
      $table->string('name_ar');
      $table->text('description_en')->nullable();
      $table->text('description_ar')->nullable();
      $table->jsonb('images')->nullable();
      $table->boolean('is_featured')->default(false);

      // Homepage Sections Fields
      $table->boolean('is_recommended')->default(false);
      $table->decimal('rating', 3, 2)->default(5.00);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('destinations');
  }
};
