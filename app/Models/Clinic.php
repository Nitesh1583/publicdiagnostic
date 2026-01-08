<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id', 'clinic_name', 'phone1', 'phone2', 'address_line1', 'landmark',
        'location', 'pincode', 'city', 'state', 'consultation_fees', 'is_default',
        'primary_doctor', 'timing_slots', 'services', 'clinic_image', 'upload_picture',
        'tax_registration_no', 'bill_no_prefix', 'bill_no', 'number_days_remarks',
        'number_days_invioce_due', 'bank_name', 'bank_account_no', 'bank_ifsc',
        'printing_header', 'visiting_dct_name_sms', 'patient_name_visiting_doctor',
        'auto_gen_patient', 'auto_gen_patient_prefix', 'auto_gen_patient_seq_no',
        'consent_add_after_patient', 'consent_clinic_default', 'consent_covid_19'
    ];

    protected $casts = [
        'timing_slots' => 'array',
        'services' => 'array',
        'is_default' => 'boolean',
        'consultation_fees' => 'decimal:2',
        'visiting_dct_name_sms' => 'boolean',
        'patient_name_visiting_doctor' => 'boolean',
        'auto_gen_patient' => 'boolean',
        'consent_add_after_patient' => 'boolean',
        'consent_clinic_default' => 'boolean',
        'consent_covid_19' => 'boolean',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }
}
