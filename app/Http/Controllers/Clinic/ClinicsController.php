<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Doctors;

class ClinicsController extends Controller
{
    public function index()
    {
        $doctor = auth('doctors')->user();

        return view('doctors.clinics.index', compact('doctor'));
    }

}
