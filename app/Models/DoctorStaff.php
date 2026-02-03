<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DoctorStaff extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'practicing_category',
        'mobile_no',
        'email',
        'clinic_id',
        'doctor_type',
        'doctors_role',
        'faq_permissions',
        'permissions'
    ];

    protected $casts = [
        'faq_permissions' => 'array',
        'permissions' => 'array'
    ];

    /**
     * Get the clinic that owns the doctor.
     */
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }

    /**
     * Scope to get resident doctors only.
     */
    public function scopeResident($query)
    {
        return $query->where('doctor_type', 'Resident');
    }

    /**
     * Scope to get visiting doctors only.
     */
    public function scopeVisiting($query)
    {
        return $query->where('doctor_type', 'Visiting');
    }

    /**
     * Get full name attribute.
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get formatted practicing category.
     */
    public function getPracticingCategoryFormattedAttribute()
    {
        return ucwords(strtolower($this->practicing_category));
    }

    /**
     * Check if doctor has specific FAQ permission.
     */
    public function hasFaqPermission($permission)
    {
        return isset($this->faq_permissions['patients']) && 
               $this->faq_permissions['patients'] == 1;
    }

    /**
     * Check if doctor has specific patient sub-permission.
     */
    public function hasPatientPermission($subPermission, $action)
    {
        return isset($this->faq_permissions['patient_permissions'][$subPermission][$action]) &&
               $this->faq_permissions['patient_permissions'][$subPermission][$action] == 1;
    }

    /**
     * Check if doctor has additional permission.
     */
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    /**
     * Get doctor type formatted.
     */
    public function getDoctorTypeFormattedAttribute()
    {
        return ucfirst(strtolower($this->doctor_type));
    }
}
