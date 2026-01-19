<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('settings/assets/css/settings-style.css') }}">
    <link rel="stylesheet" href="{{ asset('settings/assets/css/cliniclist.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 

</head>
<body>
    <a href="{{ route('doctors.dashboard') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to dashboard
    </a>

    <main>
        <div class="settings_page-container">

            <!-- PROFILE - CENTERED & COMPACT -->
            <section class="settings_profile container">
                <div class="profile-img-placeholder">

                   <div class="avatar-wrapper">
                        @if($doctor->photo && !empty($doctor->photo))
                            <img src="{{ $doctor->photo_url ?? asset('storage/' . $doctor->photo) }}" 
                                 alt="{{ $doctor->doctor_name }} Photo" class="avatar" loading="lazy">
                        @else
                            <img src="https://via.placeholder.com/160x160.png?text=Doctor" 
                                 alt="Doctor Photo" class="avatar">
                        @endif
                        
                        <div class="avatar-badge">
                            <i class="fas fa-user-md"></i>
                        </div>
                    </div>
                </div>
                
                <h3>Dr. {{ $doctor->doctor_name }}</h3>
                <a href="{{ route('doctors.profile.edit', $doctor->id) }}">
                    <i data-lucide="edit-3" style="width: 18px;"></i>
                    Edit Profile
                </a>
            </section>

            <!-- ALL YOUR SECTIONS - SAME ORDER -->
            <section class="settings_section container">
                <div class="settings_section-title">General Settings</div>
                <ul class="settings_list">
                    <a href="{{ route('doctors.clinics.index') }}">
                        <li class="settings_list-item">
                            <span>Clinics</span>
                            <i data-lucide="chevron-right"></i>
                        </li> 
                    </a>
                    <a href="#" onclick="openPopup(); return false;">
                        <li class="settings_list-item">
                            <span>Online Payment</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                     </a>
                    <a href="#">
                        <li class="settings_list-item">
                            <span>Online Appointment Booking</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                    <a href="{{ route('doctors.profile.edit', $doctor->id) }}">
                        <li class="settings_list-item">
                            <span>Change Password</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                    <a href="#">
                        <li class="settings_list-item">
                            <span>Export Data / Data Backup</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                </ul>
            </section>

            <!-- Preferences -->
            <section class="settings_section container">
                <div class="settings_section-title">Preferences</div>
                <ul class="settings_list">
                    <li class="settings_list-item">
                        <span>Account Level Preferences</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    <a href="#" onclick="openClinicListPopup(); return false;">
                        <li class="settings_list-item">
                            <span>Clinic Level Preference</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                </ul>
            </section>

            <!-- Users -->
            <section class="settings_section container">
                <div class="settings_section-title">Users</div>
                <ul class="settings_list">
                    <li class="settings_list-item">
                        <span>Doctors (Practicing Staff)</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    <li class="settings_list-item">
                        <span>Receptionist</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                </ul>
            </section>

            <!-- Masters -->
            <section class="settings_section container">
                <div class="settings_section-title">Masters</div>
                <ul class="settings_list">
                    <a href="#" onclick="openTreatmentModal()">
                        <li class="settings_list-item">
                            <span>Treatments</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="openComplaintsModal()">
                        <li class="settings_list-item">
                            <span>Complaints</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="">
                        <li class="settings_list-item">
                            <span>Observations / Notes</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="">
                        <li class="settings_list-item">
                            <span>Diagnosis</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="">
                        <li class="settings_list-item">
                            <span>Investigations</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="">
                        <li class="settings_list-item">
                            <span>Products</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <a href="#" onclick="openMedicinesModal()">
                        <li class="settings_list-item">
                            <span>Medicines</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>

                    <li class="settings_list-item"><span>Medicine Templates</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Labs / Vendors</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Medicine Instructions</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Generic Advice / Remarks</span><i data-lucide="chevron-right"></i></li>
                </ul>
            </section>

            <!-- Communications -->
            <section class="settings_section container">
                <div class="settings_section-title">Communications</div>
                <ul class="settings_list">
                    <li class="settings_list-item">
                        <span>Patient Feedback</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    
                    <a href="#" onclick="openNotificationModal(); return false;">
                        <li class="settings_list-item">
                            <span>Notification</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                    <a href="#" onclick="openPatientCommModal(); return false;">
                        <li class="settings_list-item">
                            <span>Patient Communication</span>
                            <i data-lucide="chevron-right"></i>
                        </li>
                    </a>
                </ul>
            </section>

            <!-- Add Ons -->
            <section class="settings_section container">
                <div class="settings_section-title">Add Ons</div>
                <ul class="settings_list">
                    <li class="settings_list-item"><span>Category Master</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Groups</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Taxes</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Membership Plans</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Consent Forms</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>My Rewards</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>My Devices</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Delete Account</span><i data-lucide="chevron-right"></i></li>
                </ul>
            </section>


            <!-- Online Payment Pop-Up Start here -->
            <div id="paymentPopup" class="popup-container">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Payment Settings</h2>
                        <span class="close-btn" onclick="closePopup()">&times;</span>
                    </div>
                    <form id="paymentForm" class="payment-form">
                        <div class="form-group">
                            <label>Default Payment Option</label>
                            <select name="default_payment" required>
                                <option value="">Select option</option>
                                <option value="cash">Cash</option>
                            </select>
                        </div>
                        <div class="checkbox-group">
                            <label class="checkbox-label">
                                <input type="checkbox" name="enable_online" value="1">
                                <span class="checkmark"></span>
                                Enable Online Payments
                            </label>
                            <label class="checkbox-label">
                                <input type="checkbox" name="enable_visit_payment" value="1">
                                <span class="checkmark"></span>
                                Enable Visit Level Payment Allocation
                            </label>
                        </div>
                        <button type="submit" class="save-btn">Save </button>
                    </form>
                </div>
            </div>
            <!-- Online Payment Pop-Up Ends here -->

            <!-- Clinic list Pop up start here -->
            <div id="clinicListPopup" class="popup-container">
                <div class="popup-clinic-content">
                    <div class="popup-header">
                        <h2>My Clinics</h2>
                        <span class="close-btn" onclick="closeClinicListPopup()">&times;</span>
                    </div>
                    <div class="clinics-search">
                        <input type="text" id="clinicSearch" placeholder="Search clinics..." onkeyup="filterClinics()">
                        <a href="{{ route('doctors.clinics.create') }}" class="add-clinic-btn" title="Add New Clinic">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="clinics-table-container">
                        <table class="clinics-table">
                            <!-- <thead>
                                <tr>
                                    <th>Clinic Name</th>
                                    <th>Location</th>
                                    <th>Phone</th>
                                    <th>Default</th>
                                    <th>Fees</th>
                                    <th>Actions</th>
                                </tr>
                            </thead> -->
                            <tbody id="clinicsTableBody">
                                @forelse($clinics as $clinic)
                                <tr class="clinic-card-row">
                                    <td colspan="6">
                                        <div class="clinic-card">
                                            <div class="clinic-header">
                                                <div class="clinic-icon">
                                                    <i class="fas fa-clinic-medical"></i>
                                                </div>
                                                <div class="clinic-info">
                                                    <h4>{{ $clinic->clinic_name }}</h4>
                                                    <p class="clinic-location">
                                                        <i class="fas fa-map-marker-alt"></i>
                                                        {{ $clinic->city }}, {{ $clinic->state }}
                                                    </p>
                                                </div>
                                                @if($clinic->is_default)
                                                <div class="default-badge">Default</div>
                                                @endif
                                            </div>
                                            
                                            <div class="clinic-details-grid">
                                                <div class="detail-item">
                                                    <label>Phone</label>
                                                    <div class="detail-value">{{ $clinic->phone1 ?: '-' }}</div>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Address</label>
                                                    <div class="detail-value">{{ Str::limit($clinic->address_line1, 40) }}</div>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Consultation Fees</label>
                                                    <div class="detail-value">₹{{ number_format($clinic->consultation_fees ?: 0) }}</div>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Pincode</label>
                                                    <div class="detail-value">{{ $clinic->pincode ?: '-' }}</div>
                                                </div>
                                                <div class="detail-item">
                                                    <label>Services</label>
                                                    <div class="detail-value">
                                                        @if($clinic->services && count($clinic->services) > 0)
                                                            {{ implode(', ', array_slice($clinic->services, 0, 2)) }}
                                                            @if(count($clinic->services) > 2)...{{ count($clinic->services) - 2 }} more
                                                            @endif
                                                        @else
                                                            None
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="clinic-actions">
                                                <label class="switch">
                                                    <input type="checkbox" {{ $clinic->is_default ? 'checked' : '' }} 
                                                           onchange="toggleDefault({{ $clinic->id }}, this.checked)">
                                                    <span class="slider"></span> Set Default
                                                </label>
                                                <div class="action-buttons">
                                                    <a href="#" onclick="editClinic({{ $clinic->id }})" class="btn-edit" title="Edit">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </a>
                                                    <button onclick="deleteClinic({{ $clinic->id }})" class="btn-delete" title="Delete">
                                                        <i class="fas fa-trash"></i> Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="no-clinics">
                                        <div class="empty-state">
                                            <i class="fas fa-clinic-medical" style="font-size: 48px; color: #ccc; margin-bottom: 16px;"></i>
                                            <h4>No Clinics Added</h4>
                                            <p>Add your first clinic from the Clinics tab.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                        <div id="noClinicsMsg" class="no-data" style="display: none;">
                            No clinics found.
                        </div>
                    </div>
                </div>
            </div>
            <!-- Clinic list Pop up start here -->


            <!-- Notification modal Starts here -->
            <div id="notificationModal" class="popup-container">
                <div class="popup-content">
                    <div class="popup-header">
                        <h2>Send notification daily for appointment</h2>
                        <span class="close-btn" onclick="closeNotificationModal()">&times;</span>
                    </div>
                    <form id="notificationForm" class="notification-form">
                        <div class="checkbox-group">
                            <label class="ntf-checkbox-label">
                                <input type="checkbox" name="notify_email" value="">
                                <span class="checkmark"></span>
                                <i class="fab fa-envelope"></i> Email
                            </label>
                            <label class="ntf-checkbox-label">
                                <input type="checkbox" name="notify_whatsapp" value="">
                                <span class="checkmark"></span>
                                <i class="fab fa-whatsapp"></i> WhatsApp
                            </label>
                            <label class="ntf-checkbox-label">
                                <input type="checkbox" name="notify_sms" value="">
                                <span class="checkmark"></span>
                                <i class="fas fa-sms"></i> SMS
                            </label>
                            <label class="ntf-checkbox-label">
                                <input type="checkbox" name="daily_report" value="">
                                <span class="checkmark"></span>
                                <i class="fas fa-chart-bar"></i> Send Daily Report
                            </label>
                            <label class="ntf-checkbox-label">
                                <input type="checkbox" name="list_profile" value="">
                                <span class="checkmark"></span>
                                <i class="fas fa-list"></i> List My Profile
                            </label>
                        </div>
                        <button type="submit" class="save-btn">Save Notification Settings</button>
                    </form>
                </div>
            </div>
            <!-- Notification modal Ends here -->

            <!-- Patient Communication Pop up Starts here -->
            <div id="patientCommModal" class="popup-container">
                <div class="ptcomm-popup-content">
                    <div class="popup-header">
                        <h2>Patient Communication Settings</h2>
                        <span class="close-btn" onclick="closePatientCommModal()">&times;</span>
                    </div>
                    <form id="patientCommForm" class="patient-comm-form">
                        <div class="checkbox-group">
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="checkup_reminder" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-calendar-check"></i>
                                Remind patients for regular checkup after 
                                <input type="number" name="checkup_months" min="1" max="24" placeholder="3" 
                                       class="inline-input" style="width: 60px;"> months
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="doctor_name_sms" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-user-md"></i> Include doctor name in SMS
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="clinic_name_sms" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-clinic-medical"></i> Include clinic name in SMS
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="modify_approved_visits" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-user-edit"></i> Allow other users to modify approved visits
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="past_dated_entries" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-history"></i> Allow other users to record past dated entries
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="modify_rates" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-rupee-sign"></i> Allow other users to modify treatment/medicine rates
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="payment_sms" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-receipt"></i> Payment confirmation SMS to patients
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="birthday_wishes" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-birthday-cake"></i> Send birthday wishes to patients
                            </label>

                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="doctor_name_printouts" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-print"></i> Include doctor name in all printouts
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="payments_casepaper" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-file-invoice"></i> Show payments in casepaper
                            </label>
                            
                            <label class="ptcomm-checkbox-label">
                                <input type="checkbox" name="signature_prescription" value="1">
                                <span class="checkmark"></span>
                                <i class="fas fa-signature"></i> Include signature in prescription
                            </label>
                        </div>
                        <button type="submit" class="save-btn">Save Communication Settings</button>
                    </form>
                </div>
            </div>
            <!-- Patient Communication Pop up Ends here -->


            <!-- Show All Medicines List or Add New Medicines by Doctor/ Clinic -->
            <!-- Doctor Add New Medicine Modal -->
            <div id="medicinesModal" class="popup-container">
                <div class="popup-content" style="max-width: 700px; width: 90%;">
                    <div class="popup-header">
                        <h2>Add New Medicine</h2>
                        <span class="close-btn" onclick="closeMedicinesModal()">&times;</span>
                    </div>
                    <form id="medicineForm" class="medicine-form">
                        <!-- Basic Info -->
                        <div class="form-row">
                            <div class="form-group">
                                <label>Medicine Name <span class="required">*</span></label>
                                <input type="text" name="medicine_name" required>
                            </div>
                            <div class="form-group">
                                <label>Composition</label>
                                <input type="text" name="composition" placeholder="e.g., Paracetamol 500mg">
                            </div>
                        </div>

                        <!-- Sales & Dosage -->
                        <div class="form-row">
                            <div class="form-group">
                                <label class="checkbox-label">
                                    <input type="checkbox" name="sales_to_patients" value="1" checked>
                                    <span class="checkmark"></span>
                                    Sales to patients
                                </label>
                            </div>
                            <div class="form-group">
                                <label>Dosage</label>
                                <div class="checkbox-row">
                                    <label class="dosage-checkbox">
                                        <input type="checkbox" name="dosage_timing[]" value="morning"> Mo
                                    </label>
                                    <label class="dosage-checkbox">
                                        <input type="checkbox" name="dosage_timing[]" value="afternoon"> Af
                                    </label>
                                    <label class="dosage-checkbox">
                                        <input type="checkbox" name="dosage_timing[]" value="evening"> Ev
                                    </label>
                                    <label class="dosage-checkbox">
                                        <input type="checkbox" name="dosage_timing[]" value="sos"> SOS
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Dosage Details -->
                        <div class="form-row">
                            <div class="form-group">
                                <label>Number of Days</label>
                                <input type="number" name="number_days" min="1" max="90" value="7">
                            </div>
                            <div class="form-group">
                                <label>Dosage Qty</label>
                                <input type="text" name="dosage_qty" placeholder="e.g., 1 tab / 5ml">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Instruction</label>
                                <textarea name="instruction" rows="3" placeholder="Take after meals..."></textarea>
                            </div>
                            <div class="form-group">
                                <label>Measure Unit</label>
                                <input type="text" name="measure_unit" >
                            </div>
                        </div>

                        <!-- Pricing Section -->
                        <div class="pricing-section">
                            <label class="section-label">
                                <input type="checkbox" name="price_all_clinics" id="priceAllClinics" value="1">
                                <span class="checkmark-lg"></span>
                                Display/Set price to all Clinics
                            </label>
                            
                            <div id="allClinicsPricing" class="pricing-row" style="display: none;">
                                <div class="form-group">
                                    <label>Price (₹)</label>
                                    <input type="number" name="price" step="0.01" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Purchase Price (₹)</label>
                                    <input type="number" name="purchase_price" step="0.01" min="0">
                                </div>
                                <div class="form-group">
                                    <label>Initial Stock</label>
                                    <input type="number" name="initial_stock" min="0" value="0">
                                </div>
                            </div>
                        </div>

                        <!-- Per Clinic Pricing -->
                        <div class="per-clinic-section">
                            <label class="section-label">
                                <input type="checkbox" name="per_clinic_price" value="1">
                                <span class="checkmark-lg"></span>
                                Set different price per clinic
                            </label>
                            
                            @foreach($clinics as $clinic)
                            <div class="clinic-price-group">
                                <div class="clinic-header-small">
                                    <i class="fas fa-clinic-medical"></i>
                                    {{ $clinic->clinic_name }}
                                </div>
                                <div class="price-inputs">
                                    <input type="number" name="clinic_price[{{ $clinic->id }}][price]" 
                                           placeholder="Price ₹" step="0.01">
                                    <input type="number" name="clinic_price[{{ $clinic->id }}][purchase_price]" 
                                           placeholder="Purchase ₹" step="0.01">
                                    <input type="number" name="clinic_price[{{ $clinic->id }}][stock]" 
                                           placeholder="Stock">
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <button type="submit" class="save-btn">Add Medicine</button>
                    </form>
                </div>
            </div>


                <!-- Show All treamtments by Doctor/ clinic or Add new Treatments Starts-->
                <div id="TreatmentsModal" class="popup-container">
                    <div class="popup-content" style="max-width: 750px;">
                        <div class="popup-header">
                            <h2><i class="fas fa-user-md"></i> Treatment List</h2>
                            <span class="close-btn" onclick="closeTreatmentModal()">&times;</span>
                        </div>
                        
                        <!-- Add Treatment Form Section -->
                        <div class="add-treatment-section">
                            <form method="POST" action="{{ route('doctors.treatments.store') }}" class="add-treatment-form">
                                @csrf
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Treatment Name <span class="required">*</span></label>
                                        <input type="text" name="treatment_name" required maxlength="150">
                                    </div>
                                    
                                    <!-- Checkbox Section -->
                                    <div class="form-group checkbox-group">
                                        <label class="section-label">
                                            <input type="checkbox" name="all_clinics" id="allClinics" value="1">
                                            <span class="checkmark"></span>
                                            Set price for All Clinics (Same price everywhere)
                                        </label>
                                    </div>

                                </div>

                                <!-- All Clinics Pricing (SHOW when checked) -->
                                <div id="allClinicsTreatmentPricing" class="pricing-section">
                                    <h5><i class="fas fa-clinic-medical"></i> All Clinics Pricing</h5>
                                    <div class="price-row">
                                        <div class="form-group">
                                            <label>Price (₹) <span class="required">*</span></label>
                                            <input type="number" name="price" step="0.01" min="0" >
                                        </div>
                                    </div>
                                </div>

                                <!-- Per Clinic Pricing (SHOW when NOT checked) -->
                                <div id="perClinicPricing" class="per-clinic-section">
                                    <h5><i class="fas fa-list"></i> Per Clinic Pricing</h5>
                                    @foreach($clinics as $clinic)
                                    <div class="clinic-price-card">
                                        <div class="clinic-header">
                                            <i class="fas fa-clinic-medical"></i> {{ $clinic->clinic_name }}
                                        </div>
                                        <div class="price-inputs">
                                            <input type="number" name="clinic_price[{{ $clinic->id }}][price]" placeholder="Price ₹" step="0.01" >
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Additional Fields -->
                                <div class="additional-fields">
                                    <h5><i class="fas fa-cogs"></i> Additional Details</h5>
                                    <div class="form-grid">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" rows="2" maxlength="500"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Variant</label>
                                            <input type="text" name="variant" maxlength="100">
                                        </div>
                                        <div class="form-group">
                                            <label>SAC Code</label>
                                            <input type="text" name="sac_code" maxlength="50">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="save-btn">Add Treatment</button>
                            </form>
                        </div>

                        <!-- Treatment List Section -->
                        <div class="treatment-list-section">
                            <div class="list-header">
                                <h4>Total: {{ count($treatments ?? []) }} Treatments</h4>
                            </div>
                            
                            <div class="treatments-grid">
                                @forelse($treatments ?? [] as $treatment)
                                    <div class="treatment-card">
                                        <div class="treatment-main">
                                            <div class="treatment-icon">
                                                <i class="fas fa-user-md"></i>
                                            </div>
                                            <div class="treatment-info">
                                                <h5>{{ $treatment->treatment_name }}</h5>
                                                @if($treatment->description)
                                                    <p>{{ Str::limit($treatment->description, 80) }}</p>
                                                @endif
                                                <div class="treatment-meta">
                                                    @if($treatment->clinic_prices)
                                                        <!-- Per Clinic Pricing -->
                                                        <span class="price">
                                                            <i class="fas fa-clinics"></i> 
                                                            {{ count($treatment->clinic_prices) }} Clinics
                                                            @foreach($treatment->clinic_prices as $clinicId => $priceData)
                                                                @php $clinic = $clinics->find($clinicId); @endphp
                                                                <small>
                                                                    {{ $clinic?->clinic_name ?? 'Clinic #' . $clinicId }}: ₹{{ number_format($priceData['price'], 2) }}
                                                                </small>
                                                            @endforeach
                                                        </span>
                                                    @else
                                                        <!-- All Clinics Pricing -->
                                                        <span class="price">₹{{ number_format($treatment->price, 2) }} (All Clinics)</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                        <div class="treatment-actions">
                                            <form method="POST" action="{{ route('doctors.treatments.destroy', $treatment->id) }}" 
                                                  class="delete-form" onsubmit="return confirm('Delete this treatment?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="delete-btn">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-user-md"></i>
                                        </div>
                                        <h4>No Treatments Added</h4>
                                        <p>Add your first treatment using the form above</p>
                                        <div class="empty-hint">
                                            <i class="fas fa-lightbulb"></i> Examples: Consultation, X-Ray, Blood Test
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>


            <!-- Show All treamtments by Doctor/ clinic or Add new Treatments Ends -->

            

            <!-- Show All Complaint Types Add by Doctor/ Clinic or Add new Complaints -->
            <!-- Doctor Complaint Types Modal -->
            <div id="ComplaintsModal" class="popup-container">
                <div class="popup-content" style="max-width: 650px;">
                    <div class="popup-header">
                        <h2><i class="fas fa-notes-medical"></i> Complaint Types</h2>
                        <span class="close-btn" onclick="closeComplaintsModal()">&times;</span>
                    </div>
                    
                    <!-- Add Form Section -->
                    <div class="add-complaint-section">
                        <form method="POST" action="{{ route('doctors.complaints.store') }}" class="add-complaint-form">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="name" placeholder="Enter complaint type (e.g., Fever, Back Pain, Headache)" 
                                       maxlength="100" required class="complaint-input">
                                <button type="submit" class="add-btn">
                                    <i class="fas fa-plus"></i> Add Complaint
                                </button>
                            </div>
                            @if(session('success'))
                                <div class="success-msg">{{ session('success') }}</div>
                            @endif
                        </form>
                    </div>
                    
                    <!-- Complaints List Section -->
                    <div class="complaints-list-section">
                        <div class="complaints-header">
                            <div class="header-left">
                                <h4>Total: {{ $complaints->count() ?? 0 }} Complaints</h4>
                            </div>
                        </div>
                        
                        <div class="complaints-grid">
                            @isset($complaints)
                                @forelse($complaints as $complaint)
                                    <div class="complaint-card">
                                        <div class="card-content">
                                            <div class="complaint-icon">
                                                <i class="fas fa-notes-medical"></i>
                                            </div>
                                            <div class="complaint-details">
                                                <h5>{{ $complaint->name }}</h5>
                                                <span class="added-date">
                                                    <i class="fas fa-clock"></i> {{ $complaint->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                        </div>
                                        <form method="POST" action="{{ route('doctors.complaints.destroy', $complaint->id) }}" 
                                              class="delete-form" onsubmit="return confirm('Delete {{ $complaint->name }}?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="delete-btn" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="empty-state">
                                        <div class="empty-icon">
                                            <i class="fas fa-notes-medical"></i>
                                        </div>
                                        <h4>No Complaints Added Yet</h4>
                                        <p>Start by adding your first complaint type using the form above</p>
                                        <div class="empty-hint">
                                            <i class="fas fa-lightbulb"></i> Common examples: Fever, Cough, Back Pain
                                        </div>
                                    </div>
                                @endforelse
                            @else
                                <div class="empty-state">
                                    <h4>Loading...</h4>
                                </div>
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Show All Complaint Types Add by Doctor/ Clinic -->

        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>

     <script src="{{ asset('settings/assets/js/clinicListpop-up.js') }}"></script>
    <script src="{{ asset('settings/assets/js/pop-up.js') }}"></script>
</body>
</html>
