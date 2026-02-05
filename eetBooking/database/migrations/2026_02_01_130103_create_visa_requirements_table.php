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
        Schema::create('visa_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('visa_id')->constrained('visas')->onDelete('cascade');
            $table->foreignId('nationality_id')->constrained('nationalities')->onDelete('cascade');
            $table->text('requirement_details')->nullable();
            $table->json('additional_documents')->nullable();
            $table->integer('fees')->nullable();
            $table->string('processing_time')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();

            $table->unique(['visa_id', 'nationality_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visa_requirements');
    }
};
