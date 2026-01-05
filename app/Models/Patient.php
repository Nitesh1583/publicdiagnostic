<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name', 'contact_number', 'email', 'dob', 'patient_id', 
        'gender', 'doctor_id', 'clinic_name', 'photo',
        'emergency_contact', 'category', 'blood_group', 'address',
        'aadhar_number', 'referred_by', 'legal_entity_name',
        'registration_details', 'head_of_family', 'illness', 'allergies',
        'habits', 'medical_history','attachments' 
    ];

    protected $casts = [
        'dob' => 'date',
        'illness' => 'array',
        'allergies' => 'array',
        'habits' => 'array',
        'attachments' => 'array',
    ];


    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }
}
