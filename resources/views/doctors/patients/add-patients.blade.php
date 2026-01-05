<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Patient</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('patients/assets/css/add-patients.css') }}">

</head>
<body>
    <div class="add-patient-container">
        <div class="patient-card">
            <div class="header-section">
                <i class="fas fa-user-plus fa-2x mb-3"></i>
                <h2>Add New Patient</h2>
                <p>Fill patient details to get started</p>
            </div>

            <div class="form-section">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('doctors.patients.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- BASIC INFO --}}
                    <h3 class="section-title"><i class="fas fa-user me-2"></i>Basic Information</h3>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Patient Name <span class="text-danger">*</span></label>
                            <input type="text" name="patient_name" class="form-control" value="{{ old('patient_name') }}" required>
                            @error('patient_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Contact Number <span class="text-danger">*</span></label>
                            <input type="tel" name="contact_number" class="form-control" value="{{ old('contact_number') }}" required>
                            @error('contact_number') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email ID</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        <div class="form-group">
                            <label>Date of Birth <span class="text-danger">*</span></label>
                            <input type="date" name="dob" class="form-control" value="{{ old('dob') }}" required>
                            @error('dob') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Patient ID <span class="text-info">Auto-generated</span></label>
                            <input type="text" 
                                   name="patient_id" 
                                   class="form-control bg-light" 
                                   value="{{ $auto_patient_id ?? old('patient_id') }}" 
                                   readonly 
                                   title="Auto-generated from clinic/doctor name">
                            <!-- <small class="text-muted">
                                {{ isset($auto_patient_id) ? 'Prefix: ' . substr($auto_patient_id, 0, strpos($auto_patient_id, '_')) : '' }}
                            </small> -->
                            @error('patient_id') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select name="gender" class="form-control" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Clinic Name <span class="text-danger">*</span></label>
                            <select name="clinic_name" class="form-control clinic-select" required>
                                <option value="">Select Clinic</option>
                                @foreach($clinics as $clinic)
                                    <option value="{{ $clinic }}" {{ old('clinic_name') == $clinic ? 'selected' : '' }}>{{ $clinic }}</option>
                                @endforeach
                            </select>
                            @error('clinic_name') <div class="text-danger">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    {{-- ACCORDION SECTIONS --}}
                    <div class="accordion" id="patientAccordion">

                        {{-- 1. PATIENT PERSONAL INFO --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingPersonal">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePersonal" aria-expanded="true" aria-controls="collapsePersonal">
                                    <i class="fas fa-user-circle me-2"></i> Patient Personal Info
                                </button>
                            </h2>
                            <div id="collapsePersonal" class="accordion-collapse collapse show" aria-labelledby="headingPersonal" data-bs-parent="#patientAccordion">
                                <div class="accordion-body">
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Emergency Contact</label>
                                            <input type="tel" name="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
                                            @error('emergency_contact') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Category</label>
                                            <input type="text" name="category" class="form-control" value="{{ old('category') }}" required>
                                            @error('category') <div class="text-danger">{{ $message }}
                                            </div> @enderror
                                        </div>

                                        <div class="form-group">
                            <label>Blood Group</label>
                            <select name="blood_group" class="form-control">
                                <option value="">Select Blood Group</option>
                                <option value="A+" {{ old('blood_group') == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ old('blood_group') == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ old('blood_group') == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ old('blood_group') == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB+" {{ old('blood_group') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ old('blood_group') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O+" {{ old('blood_group') == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ old('blood_group') == 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}" required>
                                            @error('address') <div class="text-danger">{{ $message }}
                                            </div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Aadhaar Number</label>
                                            <input type="text" name="aadhar_number" class="form-control" value="{{ old('aadhar_number') }}" maxlength="16">
                                            @error('aadhar_number') <div class="text-danger">{{ $message }}
                                            </div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Referred By</label>
                                            <input type="text" name="referred_by" class="form-control" value="{{ old('referred_by') }}">
                                            @error('referred_by') <div class="text-danger">{{ $message }}
                                            </div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Legal Entity Name</label>
                                            <input type="text" name="legal_entity_name" class="form-control" value="{{ old('legal_entity_name') }}">
                                            @error('legal_entity_name') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>

                                        <div class="form-group">
                                            <label>Registration Details</label>
                                            <textarea name="registration_details" class="form-control" rows="2">{{ old('registration_details') }}</textarea>
                                            @error('registration_details') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Head of Family</label>
                                            <input type="text" name="head_of_family" class="form-control" value="{{ old('head_of_family') }}">
                                            @error('head_of_family') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 2. MEDICAL DETAILS --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMedical">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMedical" aria-expanded="false" aria-controls="collapseMedical">
                                    <i class="fas fa-notes-medical me-2"></i> Medical Details
                                </button>
                            </h2>
                            <div id="collapseMedical" class="accordion-collapse collapse" aria-labelledby="headingMedical" data-bs-parent="#patientAccordion">
                                <div class="accordion-body">
                                    <div class="form-row">
                                        <div class="form-group" style="grid-column: span 2;">
                                            <label>Illness (Select all that apply)</label>
                                            <div class="checkbox-grid">
                                                @foreach(['Diabetes', 'TB', 'Heart Patient', 'BP', 'Migraine', 'Others'] as $illness)
                                                    <div class="form-check">
                                                        <input class="form-check-input illness-checkbox" type="checkbox" name="illness[]" value="{{ $illness }}" id="illness_{{ $illness }}" {{ in_array($illness, old('illness', [])) ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="illness_{{ $illness }}">{{ $illness }}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @error('illness') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Food Allergies</label>
                                            <input type="text" name="allergy_food" class="form-control" placeholder="e.g. Milk, Peanuts" value="{{ old('allergy_food') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Drug Allergies</label>
                                            <input type="text" name="allergy_drugs" class="form-control" placeholder="e.g. Penicillin, Sulfa drugs" value="{{ old('allergy_drugs') }}">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group">
                                            <label>Other Allergies</label>
                                            <input type="text" name="allergy_others" class="form-control" placeholder="e.g. Dust, Pollen" value="{{ old('allergy_others') }}">
                                        </div>
                                    </div>
                                    <h6 class="mt-3 mb-2"><i class="fas fa-smoking me-1"></i>Habits</h6>
                                    <div class="form-row">
                                        @foreach(['smoking' => 'Smoking', 'drinking' => 'Drinking', 'tobacco' => 'Tobacco'] as $key => $label)
                                            <div class="form-group">
                                                <label>{{ $label }}</label>
                                                <select name="habits[{{ $key }}]" class="form-control">
                                                    <option value="never" {{ old("habits.$key") == 'never' ? 'selected' : '' }}>Never</option>
                                                    <option value="occasional" {{ old("habits.$key") == 'occasional' ? 'selected' : '' }}>Occasional</option>
                                                    <option value="habitual" {{ old("habits.$key") == 'habitual' ? 'selected' : '' }}>Habitual</option>
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group" style="grid-column: span 2;">
                                            <label>Medical History</label>
                                            <textarea name="medical_history" class="form-control" rows="3" placeholder="Any past surgeries, chronic diseases, long-term medications etc.">{{ old('medical_history') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- 3. ATTACHMENTS --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingAttachments">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAttachments" aria-expanded="false" aria-controls="collapseAttachments">
                                    <i class="fas fa-paperclip me-2"></i> Attachments
                                </button>
                            </h2>
                            <div id="collapseAttachments" class="accordion-collapse collapse" aria-labelledby="headingAttachments" data-bs-parent="#patientAccordion">
                                <div class="accordion-body">
                                    <div class="form-row">
                                        <div class="form-group" style="grid-column: span 2;">
                                            <label>Select Attachments (max 10)</label>
                                            <input type="file" name="attachments[]" class="form-control" multiple accept=".pdf,.jpg,.jpeg,.png">
                                            <small class="text-muted">Upload lab reports, prescriptions, ID proofs etc. (PDF/JPG/PNG, max 10 files)</small>
                                            @error('attachments') <div class="text-danger">{{ $message }}</div> @enderror
                                            @error('attachments.*') <div class="text-danger">{{ $message }}</div> @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button type="submit" class="btn-submit mt-4">
                        <i class="fas fa-save me-2"></i> Submit Patient Details
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('patients/assets/js/patients.js') }}"></script>
</body>
</html>
