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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->cascadeOnDelete();
            $table->string('treatment_name', 150);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->string('variant', 100)->nullable();
            $table->string('sac_code', 50)->nullable();
            $table->json('clinic_prices')->nullable();
            $table->timestamps();

            $table->unique(['doctor_id', 'treatment_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treatments');
    }
};
