<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Models\Doctors;
use App\Models\Clinic; 

class ClinicsController extends Controller
{
    //  SHOW CLINIC TABS
    public function index()
    {
        $doctor = auth('doctors')->user();

        // CURRENT CLINIC (SESSION BASED)
        $clinic = null;
        if (session()->has('clinic_draft_id')) {
            $clinic = Clinic::where('id', session('clinic_draft_id'))
                ->where('doctor_id', $doctor->id)
                ->first();
        }

        $clinicStep = session('clinic_step', 'address');

        return view('doctors.clinics.index', compact(
            'doctor',
            'clinic',
            'clinicStep'
        ));
    }

    //START NEW CLINIC
    public function create()
    {
        session()->forget([
            'clinic_draft_id',
            'clinic_step',
        ]);

        return redirect()->route('doctors.clinics.index');
    }


    public function saveAddress(Request $request)
    {
        $doctor = auth('doctors')->user();
        $latestClinic = Clinic::where('doctor_id', $doctor->id)->latest()->first();
        
        $validated = $request->validate([
            'clinic_name' => 'required|string|max:255',
            'phone1' => 'nullable|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address_line1' => 'nullable|string|max:500',
            'landmark' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'pincode' => 'nullable|string|max:10',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
        ]);

        // ALWAYS NEW RECORD 
        $clinic = Clinic::create([
            'doctor_id' => $doctor->id,
            'clinic_name' => $validated['clinic_name'],
            'phone1' => $validated['phone1'],
            'phone2' => $validated['phone2'],
            'address_line1' => $validated['address_line1'],
            'landmark' => $validated['landmark'],
            'location' => $validated['location'],
            'pincode' => $validated['pincode'],
            'city' => $validated['city'],
            'state' => $validated['state'],
        ]);

        session([
            'clinic_draft_id' => $clinic->id,
            'clinic_step' => 'timing'
        ]);

        return redirect()->route('doctors.clinics.index', ['tab' => 'timing'])
        ->with('success', 'New clinic created! Next: Timing')
        ->with('latest_clinic', $latestClinic)
        ->with('doctor_name', $doctor->name);
    }

    public function saveTiming(Request $request)
    {
        $doctor = auth('doctors')->user();
        
        // Always gets LATEST (newest) clinic
        $clinic = Clinic::where('doctor_id', $doctor->id)->latest()->first();

        // $clinic = Clinic::findOrFail(session('clinic_draft_id'));

        $validated = $request->validate([
            'consultation_fees' => 'nullable|numeric|min:0|max:999999',
        ]);

        $clinic->update([
            'is_default' => $request->boolean('is_default'),
            'consultation_fees' => $validated['consultation_fees'],
            'timing_slots' => $request->input('timing_slots') ? json_decode($request->input('timing_slots'), true) : null,
        ]);

        session(['clinic_step' => 'setup']);

        return redirect()->route('doctors.clinics.index', ['tab' => 'setup'])
        ->with('success', 'Timing saved!');
    }

    public function saveSetup(Request $request)
    {
        $doctor = auth('doctors')->user();
        // $clinic = Clinic::where('doctor_id', $doctor->id)->latest()->first();
        $clinic = Clinic::findOrFail(session('clinic_draft_id'));


        $clinic->update([
            'primary_doctor' => $request->input('primary_doctor'),
            'tax_registration_no' => $request->input('tax_registration_no'),
            'bill_no_prefix' => $request->input('bill_no_prefix'),
            'bill_no' => $request->input('bill_no'),
            'number_days_remarks' => $request->input('number_days_remarks'),
            'number_days_invioce_due' => $request->input('number_days_invioce_due'),
            'bank_name' => $request->input('bank_name'),
            'bank_account_no' => $request->input('bank_account_no'),
            'bank_ifsc' => $request->input('bank_ifsc'),
            'printing_header' => $request->input('printing_header', 'default'),
            'visiting_dct_name_sms' => $request->boolean('visiting_dct_name_sms'),
            'patient_name_visiting_doctor' => $request->boolean('patient_name_visiting_doctor'),
            'auto_gen_patient' => $request->boolean('auto_gen_patient'),
            'auto_gen_patient_prefix' => $request->input('auto_gen_patient_prefix'),
            'auto_gen_patient_seq_no' => $request->input('auto_gen_patient_seq_no'),
            'consent_add_after_patient' => $request->boolean('consent_add_after_patient'),
            'consent_clinic_default' => $request->boolean('consent_clinic_default'),
            'consent_covid_19' => $request->boolean('consent_covid_19'),
        ]);

        session(['clinic_step' => 'picture']);

        return redirect()->route('doctors.clinics.index', ['tab' => 'picture'])
        ->with('success', 'Setup saved!');
    }

    public function savePicture(Request $request)
    {
        $doctor = auth('doctors')->user();
        $clinic = Clinic::where('doctor_id', $doctor->id)->latest()->first();
        $clinic = Clinic::findOrFail(session('clinic_draft_id'));


        if ($request->hasFile('upload_picture')) {
            if ($clinic->clinic_image) {
                Storage::disk('public')->delete($clinic->clinic_image);
            }
            $path = $request->file('upload_picture')->store('clinics/images', 'public');
            $clinic->update([
                'clinic_image' => $path,
                'upload_picture' => $path,
            ]);
        }

        session(['clinic_step' => 'services']);

        return redirect()->route('doctors.clinics.index', ['tab' => 'services'])
        ->with('success', 'Picture saved!');;
    }

    public function saveServices(Request $request)
    {
        $doctor = auth('doctors')->user();
        // $clinic = Clinic::where('doctor_id', $doctor->id)->latest()->first();
         $clinic = Clinic::findOrFail(session('clinic_draft_id'));

        $services = array_filter(array_map('trim', explode(',', $request->input('add_services', ''))));

        $clinic->update([
            'services' => $services,
            // 'clinic_name' => $clinic->clinic_name !== 'Draft' ? $clinic->clinic_name : 'New Clinic',
        ]);

        session()->forget(['clinic_step', 'clinic_draft_id']);

        return redirect()->route('doctors.clinics.index')->with('success', 'Clinic created successfully!');
    }


    // SHOW ALL CLINICS LIST FUNCTION
        // public function getClinicsList()
        // {
        //     $doctor = auth('doctors')->user();
        //     $clinics = Clinic::where('doctor_id', $doctor->id)
        //         ->orderByDesc('is_default')
        //         ->orderBy('created_at', 'desc')
        //         ->get([
        //             'id', 'clinic_name', 'city', 'state', 'phone1', 
        //             'consultation_fees', 'is_default'
        //         ]);
            
        //     return response()->json([
        //     'success' => true,
        //     'clinics' => $clinics->toArray()  // Convert to array
        // ]);
        // }

        // public function getClinicsList()
        // {
        //     $doctor = auth('doctors')->user();
        //     $clinics = Clinic::where('doctor_id', $doctor->id)
        //         ->orderByDesc('is_default')
        //         ->orderBy('created_at', 'desc')
        //         ->get();

        //     return response()->json([
        //         'success' => true,
        //         'html' => view('doctors.settings.index', compact('clinics'))->render()
        //     ]);
        // }


    public function setDefault(Request $request, $id)
    {
        $doctor = auth('doctors')->user();
        
        // Reset all clinics to non-default
        Clinic::where('doctor_id', $doctor->id)->update(['is_default' => false]);
        
        // Set selected clinic as default
        Clinic::where('id', $id)
            ->where('doctor_id', $doctor->id)
            ->update(['is_default' => true]);
        
        return response()->json(['success' => true]);
    }
}