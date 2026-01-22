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
        Schema::create('doctor_staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 155);
            $table->string('last_name', 155);
            $table->string('practicing_category', 155);
            $table->string('mobile_no', 20)->unique();
            $table->string('email', 155)->unique();
            $table->foreignId('clinic_id')->constrained()->onDelete('cascade');
            $table->enum('doctor_type', ['Resident', 'Visiting']);
            $table->json('faq_permissions')->nullable();
            $table->json('permissions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_staff');
    }
};
