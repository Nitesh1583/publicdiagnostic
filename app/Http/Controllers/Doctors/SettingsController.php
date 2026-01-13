<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Clinic;

class SettingsController extends Controller
{
    public function index()
    {
        $doctor = auth('doctors')->user();
        $clinics = Clinic::where('doctor_id', $doctor->id)
                ->orderByDesc('is_default')
                ->orderBy('created_at', 'desc')
                ->get();
        return view('doctors.settings.index', compact( 'doctor', 'clinics'));
    }
}
