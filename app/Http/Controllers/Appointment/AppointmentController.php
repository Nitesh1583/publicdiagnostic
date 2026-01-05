<?php

namespace App\Http\Controllers\Appointment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctors;
use Illuminate\Support\Facades\Validator; 

class AppointmentController extends Controller
{
    public function index()
    {
        $doctor = auth('doctors')->user();
        $appointments = Appointment::with('patient')  // ← Simple relation name
            ->where('doctor_id', $doctor->id)
            ->orderBy('appointment_date')
            ->orderBy('appointment_time')
            ->paginate(20);

        return view('doctors.appointments.index', compact('appointments', 'doctor'));
    }

    public function create(Request $request)
    {
        $doctor = auth('doctors')->user();
        $patients = Patient::where('doctor_id', $doctor->id)
            ->orderBy('patient_name')
            ->get(['id', 'patient_name', 'patient_id']);

        $preselectedPatient = $request->patient_id ?? null;
        $preselectedDate = $request->date ?? now()->format('Y-m-d');
        $preselectedTime = $request->time ?? '10:00';

        return view('doctors.appointments.create', compact('patients', 'doctor', 'preselectedPatient', 'preselectedDate', 'preselectedTime'));
    }

    public function store(Request $request)
    {
        $doctor = auth('doctors')->user();

        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Check for time conflict
        $conflict = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_date', $request->appointment_date)
            ->where('appointment_time', $request->appointment_time)
            ->exists();

        if ($conflict) {
            return back()->withErrors(['appointment_time' => 'This time slot is already booked!'])->withInput();
        }

        Appointment::create([
            'doctor_id' => $doctor->id,
            'patient_id' => $request->patient_id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
            'status' => 'scheduled',
            'notes' => $request->notes,
        ]);

        return redirect()->route('doctors.appointments.index')
            ->with('success', 'Appointment booked successfully!');
    }


    public function edit(Appointment $appointment)
    {
        $doctor = auth('doctors')->user();
        
        // Only allow editing own appointments
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403, 'Not authorized');
        }
        
        $patients = Patient::where('doctor_id', $doctor->id)->get();
        
        return view('doctors.appointments.edit', compact('appointment', 'patients', 'doctor'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $doctor = auth('doctors')->user();
        
        // Authorization check
        if ($appointment->doctor_id !== $doctor->id) {
            abort(403);
        }
        
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,scheduled,checked-in,engaged,completed,cancelled',
            'notes' => 'nullable|string|max:500',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $appointment->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);
        
        return redirect()->route('doctors.dashboard')
            ->with('success', 'Appointment updated successfully!');
    }
}
