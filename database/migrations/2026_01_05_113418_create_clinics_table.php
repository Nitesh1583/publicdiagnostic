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
            
            // Address & Contact
            $table->string('clinic_name', 155);
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->text('address_line1', 155)->nullable();
            $table->string('landmark', 155)->nullable();
            $table->string('location', 155)->nullable();
            $table->string('pincode', 10)->nullable();
            $table->string('city', 155)->nullable();
            $table->string('state', 155)->nullable();

            // Core Clinic Settings
            $table->decimal('consultation_fees', 10, 2)->nullable();
            $table->boolean('is_default')->default(false);
            
            // **TIMING SLOTS** (Your Modal Data)
            $table->json('timing_slots')->nullable();

            $table->string('primary_doctor', 155)->nullable();
            
            // Billing Settings
            $table->string('tax_registration_no', 155)->nullable();
            $table->string('bill_no_prefix', 155)->nullable();
            $table->string('bill_no', 155)->nullable();
            $table->string('number_days_remarks', 155)->nullable();
            $table->string('number_days_invioce_due', 155)->nullable();

            // Bank Details
            $table->string('bank_name', 155)->nullable();
            $table->string('bank_account_no', 155)->nullable();
            $table->string('bank_ifsc', 155)->nullable();

            // Printing Settings
            $table->enum('printing_header', ['default', 'logo', 'letterhead'])
                  ->default('default');

            // Images
            $table->string('clinic_image')->nullable();
            $table->string('logo_image')->nullable();
            $table->string('letterhead_image')->nullable();

            //Patient section 
            $table->boolean('visiting_dct_name_sms')->default(false);
            $table->boolean('patient_name_visiting_doctor')->default(false);
            $table->boolean('auto_gen_patient')->default(false);

            $table->string('auto_gen_patient_prefix')->nullable();
            $table->string('auto_gen_patient_seq_no')->nullable();
            
            //consents
            $table->boolean('consent_add_after_patient')->default(false);
            $table->boolean('consent_clinic_default')->default(false);
            $table->boolean('consent_covid_19')->default(false);

            //pictures
            $table->string('upload_picture')->nullable();
            
            //Services List
            $table->json('services')->nullable();

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
