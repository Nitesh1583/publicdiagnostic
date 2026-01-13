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
                    <li class="settings_list-item"><span>Treatments</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Complaints</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Observations / Notes</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Diagnosis</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Investigations</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Products</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Medicines</span><i data-lucide="chevron-right"></i></li>
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
                    <li class="settings_list-item"><span>Patient Communication</span><i data-lucide="chevron-right"></i></li>
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
            
            <!-- Patient Communication Pop up Ends here -->

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
