<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Treatment extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'treatment_name',
        'price',
        'purchase_price',
        'description',
        'variant',
        'sac_code',
        'clinic_prices', // JSON for per-clinic pricing
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'purchase_price' => 'decimal:2',
        'clinic_prices' => 'array',
    ];

    // Doctor relationship
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // Scope: Doctor's treatments only
    public function scopeByDoctor($query, $doctorId)
    {
        return $query->where('doctor_id', $doctorId);
    }

    // Accessor: Formatted price
    public function getFormattedPriceAttribute()
    {
        return '₹' . number_format($this->price, 2);
    }

    // Check if has clinic-specific pricing
    public function hasClinicPricing()
    {
        return !empty($this->clinic_prices);
    }
}
