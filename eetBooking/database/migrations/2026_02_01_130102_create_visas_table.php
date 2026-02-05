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
        Schema::create('visas', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->foreignId('destination_id')->constrained('destinations')->onDelete('cascade');
            $table->text('image_url')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->default('EGP');
            $table->string('processing_time')->nullable();
            $table->json('required_documents')->nullable();
            $table->string('validity_period')->nullable();
            $table->string('entry_type')->nullable(); // single, multiple, etc.
            $table->boolean('active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visas');
    }
};
