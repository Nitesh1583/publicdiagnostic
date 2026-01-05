<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('patient_name', 255);
            $table->string('contact_number', 20);
            $table->string('email', 191)->nullable();
            $table->date('dob');
            $table->string('patient_id', 50)->unique();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->foreignId('doctor_id')->constrained('doctors')->onDelete('cascade');
            $table->string('clinic_name', 255);
            
            // Personal Info
            $table->string('photo')->nullable();
            $table->string('emergency_contact', 255)->nullable();
            $table->string('category', 255)->nullable();
            $table->string('blood_group',255)->nullable();
            $table->string('address', 191)->nullable();
            $table->string('aadhar_number', 155)->nullable();
            $table->string('referred_by', 255)->nullable();
            $table->string('legal_entity_name', 255)->nullable();
            $table->string('registration_details', 255)->nullable();
            $table->string('head_of_family', 255)->nullable();
            
            // Medical Details
            $table->json('illness')->nullable();
            $table->json('allergies')->nullable();
            $table->json('habits')->nullable();
            $table->text('medical_history')->nullable();
            
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('patients');
    }
};
