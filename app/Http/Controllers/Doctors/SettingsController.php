<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;
use App\Models\Clinic;
use App\Models\ComplaintType;
use App\Models\Treatment;

class SettingsController extends Controller
{   
    // Main page function ======================>
    public function index()
    {
        $doctor = auth('doctors')->user();
        $clinics = Clinic::where('doctor_id', $doctor->id)
                ->orderByDesc('is_default')
                ->orderBy('created_at', 'desc')
                ->get();
        $complaints = ComplaintType::where('doctor_id', $doctor->id)->get();
        $treatments = Treatment::where('doctor_id', $doctor->id)->get(); // Add this!

        return view('doctors.settings.index', compact( 'doctor', 'clinics', 'complaints', 'treatments'));
    }

    // Save Notification tab function ==============>
    public function saveNotificationSettings(Request $request)
    {
        $doctor = auth('doctors')->user();
        $doctor->update($request->only([
            'notify_email', 'notify_whatsapp', 'notify_sms', 
            'daily_report', 'list_profile'
        ]));
        
        return response()->json(['success' => true]);
    }

    //Save Patient Communication Tab Function ============>
    public function savePatientCommSettings(Request $request)
    {
        $doctor = auth('doctors')->user();
        $data = $request->only([
            'checkup_reminder', 'checkup_months', 'doctor_name_sms', 
            'clinic_name_sms', 'modify_approved_visits', 'past_dated_entries',
            'modify_rates', 'payment_sms', 'birthday_wishes',
            // NEW FIELDS
            'doctor_name_printouts', 'payments_casepaper', 'signature_prescription'
        ]);
        
        $doctor->update($data);
        return response()->json(['success' => true]);
    }

    //Save Medicine Tab Function ===========================>
    public function storeMedicine(Request $request)
    {
        $doctor = auth('doctors')->user();
        
        $validatedData = $request->validate([
            // Required Basic Fields
            'medicine_name' => 'required|string|max:255|unique:medicines,medicine_name',
            
            // Optional Basic Fields
            'composition' => 'nullable|string|max:500',
            'instruction' => 'nullable|string|max:1000',
            'dosage_qty' => 'nullable|string|max:50',
            
            // Boolean Checkboxes
            'sales_to_patients' => 'boolean',
            
            // Dosage Timing Array (Mo, Af, Ev, SOS)
            'dosage_timing' => 'nullable|array|max:4',
            'dosage_timing.*' => 'in:morning,afternoon,evening,sos',
            
            // Numeric Fields
            'number_days' => 'required|integer|min:1|max:365',
            'checkup_months' => 'nullable|integer|min:1|max:24', // If used elsewhere
            
            // Pricing Fields (All Clinics)
            'price' => 'required_if:price_all_clinics,1|nullable|numeric|min:0|max:999999.99',
            'purchase_price' => 'nullable|numeric|min:0|max:999999.99',
            'initial_stock' => 'required|integer|min:0|max:999999',
            
            // Per Clinic Pricing (Array validation)
            'clinic_price' => 'nullable|array',
            'clinic_price.*.price' => 'nullable|numeric|min:0|max:999999.99',
            'clinic_price.*.purchase_price' => 'nullable|numeric|min:0|max:999999.99',
            'clinic_price.*.stock' => 'nullable|integer|min:0|max:999999',
            
            // Unit Selection
            // 'measure_unit' => 'required|string|in:tab,ml,mg,gm,tbs,capsule,drop,vial,syp,inj',
            'measure_unit' => 'required|string|max:255',
            
            // Conditional Logic
            'price_all_clinics' => 'boolean',
            'per_clinic_price' => 'boolean',
            
            // Ensure at least one pricing method
            'price_all_clinics' => 'required_without:per_clinic_price',
            'per_clinic_price' => 'required_without:price_all_clinics',
        ], [
            'medicine_name.unique' => 'Medicine name already exists.',
            'medicine_name.required' => 'Medicine name is required.',
            'number_days.required' => 'Number of days is required.',
            'measure_unit.required' => 'Please select measure unit.',
            'price_all_clinics.required_without' => 'Please select pricing method (All Clinics OR Per Clinic).',
        ]);
        
        // Transform checkbox data
        $validatedData['sales_to_patients'] = $request->boolean('sales_to_patients');
        $validatedData['dosage_timing'] = $request->input('dosage_timing', []);
        $validatedData['price_all_clinics'] = $request->boolean('price_all_clinics');
        $validatedData['per_clinic_price'] = $request->boolean('per_clinic_price');
        
        // Handle clinic prices JSON
        if ($validatedData['price_all_clinics']) {
            $validatedData['clinic_prices'] = null;
        } else {
            $clinicPrices = [];
            foreach ($request->clinic_price ?? [] as $clinicId => $prices) {
                $clinicPrices[$clinicId] = [
                    'price' => $prices['price'] ?? 0,
                    'purchase_price' => $prices['purchase_price'] ?? 0,
                    'stock' => $prices['stock'] ?? 0
                ];
            }
            $validatedData['clinic_prices'] = $clinicPrices;
        }
        
        // Create medicine
        $medicine = Medicine::create(array_merge($validatedData, [
            'doctor_id' => $doctor->id
        ]));
        
        return response()->json([
            'success' => true, 
            'message' => 'Medicine added successfully!',
            'medicine' => $medicine
        ]);
    }



    // Add, Delete or Show All Complaints types Work Starts here ===============>

    // 1. For modal opening (loads HTML)
    public function complaints()
    {
        $doctor = auth('doctors')->user();
        $complaints = ComplaintType::where('doctor_id', $doctor->id)->get();
        return view('doctors.settings.partials.complaints-modal', compact('complaints'));
    }

    // 2. For AJAX list loading (if using JS version)
    public function complaintsModal()
    {
        $doctor = auth('doctors')->user();
        $complaints = ComplaintType::where('doctor_id', $doctor->id)->get();
        return view('doctors.settings.partials.complaints-modal', compact('complaints'));
    }

    // 3. Store (POST /complaints)
    public function storeComplaint(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:complaint_types,name,NULL,id,doctor_id,' . auth('doctors')->id()
        ]);
        
        ComplaintType::create([
            'doctor_id' => auth('doctors')->user()->id,
            'name' => $request->name
        ]);
        
        return back()->with('success', 'Complaint type added!');
    }

    // 4. Delete (DELETE /complaints/{id})
    public function destroyComplaint(Request $request, $id)
    {

        $complaint = ComplaintType::where('doctor_id', auth('doctors')->user()->id)
                         ->where('id', $id)
                         ->firstOrFail();

        $complaint->delete();
        return back()->with('success', 'Complaint type deleted!');
    }


    // Add, Delete or Show All Complaints types Work ENDs here =================>


    // Add, Delete or show All Treatment Work Starts Here  =====================>
    public function treatments()

    {
        $doctor = auth('doctors')->user();
        $clinics = Clinic::where('doctor_id', $doctor->id)->get();
        $treatments = Treatment::where('doctor_id', $doctor->id)->with('clinics')->get();
        
        return view('doctors.settings.partials.treatments-modal', compact('clinics', 'treatments'));
    }

    public function storeTreatment(Request $request)
    {
        $doctorId = auth('doctors')->user()->id;
        
        $request->validate([
            'treatment_name' => 'required|string|max:150|unique:treatments,treatment_name,NULL,id,doctor_id,' . $doctorId,
            'price' => 'required_if:all_clinics,1|nullable|numeric|min:0|max:999999.99',
            'clinic_price' => 'required_if:all_clinics,0|nullable|array',
            'clinic_price.*.price' => 'required_if:all_clinics,0|nullable|numeric|min:0|max:999999.99',
            'description' => 'nullable|string|max:500',
        ]);

        $data = [
            'doctor_id' => $doctorId,
            'treatment_name' => $request->treatment_name,
            'description' => $request->description,
            'variant' => $request->variant,
            'sac_code' => $request->sac_code,
        ];

        // ✅ LOGIC: All Clinics OR Per Clinic
        if ($request->boolean('all_clinics')) {
            // All Clinics - save single price
            $data['price'] = $request->price;
            $data['clinic_prices'] = null; // Clear per-clinic prices
        } else {
            // Per Clinic - save clinic prices as JSON
            $clinicPrices = [];
            if ($request->has('clinic_price')) {
                foreach ($request->clinic_price as $clinicId => $prices) {
                    if (!empty($prices['price'])) {
                        $clinicPrices[$clinicId] = [
                            'price' => (float) $prices['price']
                        ];
                    }
                }
            }
            $data['price'] = null; // Clear single price
            $data['clinic_prices'] = !empty($clinicPrices) ? $clinicPrices : null;
        }

        $treatment = Treatment::create($data);
        return back()->with('success', 'Treatment saved successfully!');
    }


    public function destroyTreatment($id)
    {
        $treatment = Treatment::where('doctor_id', auth('doctors')->user()->id)->findOrFail($id);
        $treatment->delete();
        return back()->with('success', 'Treatment deleted!');
    }

    // Add, Delete or show All Treatment Work Starts Here  =====================>

}
