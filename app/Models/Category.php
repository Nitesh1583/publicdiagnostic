<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['doctor_id', 'category_name'];
    
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
