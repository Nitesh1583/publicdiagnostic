<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use App\Models\Patient;
use App\Models\Appointment; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DoctorsDashboardController extends Controller
{
    public function index()
    {
        $doctor = auth('doctors')->user();

        // Query recent appointments (last 30 days) grouped by status
        $appointmentsByStatus = [
            'appointments' => Appointment::with('patient')
                ->where('doctor_id', $doctor->id)
                ->whereIn('status', ['pending', 'scheduled'])
                ->where('appointment_date', '>=', now()->subDays(30))
                ->orderBy('appointment_date', 'asc')
                ->orderBy('appointment_time', 'asc')
                ->take(10)
                ->get(),
            
            'checkin' => Appointment::with('patient')
                ->where('doctor_id', $doctor->id)
                ->where('status', 'checked-in')  // Or 'check-in'
                ->where('appointment_date', '>=', now()->subDays(30))
                ->orderBy('appointment_date', 'asc')
                ->take(10)
                ->get(),
                
            'engaged' => Appointment::with('patient')
                ->where('doctor_id', $doctor->id)
                ->where('status', 'engaged')  // Or 'in-progress'
                ->where('appointment_date', '>=', now()->subDays(30))
                ->orderBy('appointment_date', 'asc')
                ->take(10)
                ->get(),
                
            'completed' => Appointment::with('patient')
                ->where('doctor_id', $doctor->id)
                ->where('status', 'completed')
                ->where('appointment_date', '>=', now()->subDays(30))
                ->orderBy('appointment_date', 'desc')
                ->take(10)
                ->get()
        ];
        
        // Counts for tab headers
        $counts = [
            'appointments_count' => $appointmentsByStatus['appointments']->count(),
            'checkin_count' => $appointmentsByStatus['checkin']->count(),
            'engaged_count' => $appointmentsByStatus['engaged']->count(),
            'completed_count' => $appointmentsByStatus['completed']->count()
        ];
    
        //  Total Patients Count
        $total_patients = Patient::where('doctor_id', $doctor->id)->count();
        
        // Other stats (add your existing ones)
        $new_patients = Patient::where('doctor_id', $doctor->id)
                              ->where('created_at', '>=', now()->subDays(30))
                              ->count();
        

        return view('doctors.dashboard', compact(
            'doctor', 
            'appointmentsByStatus', 
            'counts',
            'new_patients', 
            'total_patients'
        ));
    }
}