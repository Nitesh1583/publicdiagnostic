<?php
namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Doctors;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function create()
    {
        $doctor = auth('doctors')->user();
        
        $clinics = Clinic::where('doctor_id', $doctor->id)->pluck('clinic_name', 'id'); 

        // Get clinic prefix and sequence settings
        $clinic = Clinic::where('doctor_id', $doctor->id)->first(); // Get first/default clinic
        $clinicsPrefixFirst = $clinic ? $clinic->auto_gen_patient_prefix : null;
        $clinicsPrefixSecond = $clinic ? $clinic->auto_gen_patient_seq_no : null;

        // Smart prefix: Clinic name first → fallback to Doctor name
        $prefix = $clinicsPrefixFirst ?? $this->generateSmartPrefix($doctor);
        $auto_patient_id = $this->generateNextPatientId($prefix);
        
        return view('doctors.patients.add-patients', compact('clinics', 'doctor', 'auto_patient_id', 
            'clinicsPrefixFirst'));
    }

    private function generateSmartPrefix($doctor)
    {
        // 1. Try clinic name first (first 3 letters)
        // if (!empty($doctor->clinic_name)) {
        //     $clinic_prefix = $this->cleanName($doctor->clinic_name);
        //     if (strlen($clinic_prefix) >= 2) {
        //         return substr($clinic_prefix, 0, 3) . '_';
        //     }
        // }

        // Fallback if no clinic prefix
        if (!empty($doctor->business_category)) { // Updated from clinic_name
            $prefix = $this->cleanName($doctor->business_category);
            return substr($prefix, 0, 3) . '_';
        }

        // 2. Fallback to doctor name (first 3 letters)
        $doctor_prefix = $this->cleanName($doctor->doctor_name);
        return substr($doctor_prefix, 0, 3) . '_';
    }

    private function cleanName($name)
    {
        // Remove special chars, spaces → only letters → lowercase
        return strtolower(preg_replace('/[^a-zA-Z]/', '', $name));
    }

    private function generateNextPatientId($prefix)
    {
        $doctor = auth('doctors')->user();
        
        // Count existing patients for this doctor with this prefix
        $count = Patient::where('doctor_id', $doctor->id)
                       ->where('patient_id', 'LIKE', $prefix . '%')
                       ->count();
        
        // Generate next number (001, 002, etc.)
        $next_number = str_pad($count + 1, 3, '0', STR_PAD_LEFT);
        return $prefix . $next_number;
    }

    public function store(Request $request)
    {
        $doctor = auth('doctors')->user();

        // Auto-generate Patient ID if empty
        if (empty($request->patient_id)) {
            $clinic = Clinic::where('doctor_id', $doctor->id)->first();
            // $prefix = $this->generateSmartPrefix($doctor);
            $prefix = $clinic->auto_gen_patient_prefix ?? $this->generateSmartPrefix($doctor);

            $request->merge(['patient_id' => $this->generateNextPatientId($prefix)]);
        }
        
        $request->validate([
            'patient_name' => 'required|string|max:255',
            'contact_number' => 'required|string|max:15',
            'email' => 'nullable|email|unique:patients,email',
            'dob' => 'required|date',
            'patient_id' => 'required|string|unique:patients,patient_id|max:50',
            'gender' => 'required|in:Male,Female,Other',
            'clinic_name' => 'required|string|max:255',
            
            // Personal Info - Match form fields exactly
            'emergency_contact' => 'nullable|string|max:15',
            'category' => 'nullable|string|max:100',  // ← NEW
            'blood_group' => 'nullable|string|max:5',
            'address' => 'nullable|string|max:500',  // ← CHANGED from 'text'
            'aadhar_number' => 'nullable|string|max:16',
            'referred_by' => 'nullable|string|max:255',
            'legal_entity_name' => 'nullable|string|max:255',
            'registration_details' => 'nullable|string',  // ← CHANGED from 'text'
            'head_of_family' => 'nullable|string|max:255',
            
            // Illness checkboxes
            'illness' => 'nullable|array',
            'illness.*' => 'in:Diabetes,TB,Heart Patient,BP,Migraine,Others',
            
            // Allergies
            'allergy_food' => 'nullable|string|max:255',
            'allergy_drugs' => 'nullable|string|max:255',
            'allergy_others' => 'nullable|string|max:255',
            
            // Habits -  FIXED validation syntax
            'habits' => 'nullable|array',
            'habits.smoking' => 'nullable|in:never,occasional,habitual',
            'habits.drinking' => 'nullable|in:never,occasional,habitual',
            'habits.tobacco' => 'nullable|in:never,occasional,habitual',
            
            'medical_history' => 'nullable|string',
            
            // Attachments
            'attachments' => 'nullable|array|max:10',
            'attachments.*' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'patient_name', 'contact_number', 'email', 'dob', 'patient_id',
            'gender', 'clinic_name', 'emergency_contact', 'category',  
            'blood_group', 'address', 'aadhar_number', 'referred_by',
            'legal_entity_name', 'registration_details', 'head_of_family',
            'medical_history'
        ]);
        
        $data['doctor_id'] = $doctor->id;

        // Illness array
        $data['illness'] = $request->input('illness', []);

        // Allergies as JSON
        $data['allergies'] = [
            'food' => trim($request->input('allergy_food', '')),
            'drugs' => trim($request->input('allergy_drugs', '')),
            'others' => trim($request->input('allergy_others', '')),
        ];

        // Habits as JSON
        $habits = [];
        $habitKeys = ['smoking', 'drinking', 'tobacco'];
        foreach ($habitKeys as $key) {
            if ($request->filled("habits.{$key}")) {
                $habits[$key] = $request->input("habits.{$key}");
            }
        }
        $data['habits'] = $habits;

        // Attachments
        $attachmentPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if ($file->isValid()) {
                    $attachmentPaths[] = $file->store('patient-attachments', 'public');
                }
            }
        }
        $data['attachments'] = !empty($attachmentPaths) ? json_encode($attachmentPaths) : null;

        Patient::create($data);

        return redirect()->route('doctors.dashboard')
            ->with('success', 'Patient added successfully!');
    }

    //new
    public function generatePatientId($clinicName, $doctorId)
    {
        $doctor = Doctors::findOrFail($doctorId);
        
        // Find clinic by name (or use clinic_id if you change select value)
        $clinic = Clinic::where('doctor_id', $doctorId)
                       ->where('clinic_name', $clinicName)
                       ->first();
        
        // Get prefix from clinic or generate from clinic name
        $prefix = $clinic ? $clinic->auto_gen_patient_prefix : $this->cleanName($clinicName);
        if (!$prefix) {
            $prefix = substr($this->cleanName($clinicName), 0, 3) . '_';
        }
        
        $nextId = $this->generateNextPatientId($prefix);
        
        return response()->json([
            'success' => true,
            'patient_id' => $nextId
        ]);
    }


    public function patientsList(Request $request)
    {
        $doctor = auth('doctors')->user();
        
        $query = Patient::where('doctor_id', $doctor->id);
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('patient_name', 'LIKE', "%{$search}%")
                  ->orWhere('patient_id', 'LIKE', "%{$search}%")
                  ->orWhere('contact_number', 'LIKE', "%{$search}%")
                  ->orWhere('clinic_name', 'LIKE', "%{$search}%");
            });
        }
        
        // Filter by gender if provided
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        
        $patients = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Preserve search params in pagination links
        if ($request->filled('search') || $request->filled('gender')) {
            $patients->appends($request->only(['search', 'gender']));
        }

        return view('doctors.patients.patient-list', compact('patients', 'doctor', 'request'));
    }
}
