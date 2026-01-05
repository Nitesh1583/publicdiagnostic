<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;

class SettingsController extends Controller
{
    public function index()
    {
        $doctor = auth('doctors')->user();
        return view('doctors.settings.index', compact( 'doctor'));
    }
}
