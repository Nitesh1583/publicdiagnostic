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
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            
            $table->string('clinic_name');
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->text('address_line1')->nullable();
            $table->string('landmark')->nullable();
            $table->string('location')->nullable();
            $table->string('pincode')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();

            $table->decimal('consultation_fees', 10, 2)->nullable();
            $table->boolean('is_default')->default(false);

            $table->string('primary_doctor')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
