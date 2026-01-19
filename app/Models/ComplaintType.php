<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ComplaintType extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'name',
    ];

    protected $casts = [
        'doctor_id' => 'integer',
    ];

    // Relationship: Belongs to Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Scope: Get complaints by doctor
    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    // Scope: Search by name
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'LIKE', "%{$search}%");
    }
}
