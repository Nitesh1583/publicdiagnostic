<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'doctor_id', 'patient_id', 'appointment_date', 
        'appointment_time', 'status', 'notes'
    ];

    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime:H:i',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctors::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
