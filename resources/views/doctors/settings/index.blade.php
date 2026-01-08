<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('settings/assets/css/settings-style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

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
                    <li class="settings_list-item">
                        <span>Online Payment</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    <li class="settings_list-item">
                        <span>Online Appointment Booking</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    <li class="settings_list-item">
                        <span>Change Password</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
                    <li class="settings_list-item">
                        <span>Export Data / Data Backup</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
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
                    <li class="settings_list-item">
                        <span>Clinic Level Preference</span>
                        <i data-lucide="chevron-right"></i>
                    </li>
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
                    <li class="settings_list-item"><span>Patient Feedback</span><i data-lucide="chevron-right"></i></li>
                    <li class="settings_list-item"><span>Notification</span><i data-lucide="chevron-right"></i></li>
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
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
