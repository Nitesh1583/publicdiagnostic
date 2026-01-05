<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor / Clinic Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('doctors/assets/css/doctorsprofile.css') }}">

</head>
<body>
<div class="profile-wrapper">

    <a href="{{ route('doctors.dashboard') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to dashboard
    </a>

    <div class="profile-card">
        <!-- Header -->
        <div class="profile-header">
            <div class="profile-header-top">
                <div class="badge-category">
                    <i class="fas fa-stethoscope"></i>
                    <span>{{ $doctor->category ?? 'Doctor' }}</span>
                </div>
                <span class="status-pill">
                    <i class="fas fa-circle me-1" style="font-size:7px;color:#22c55e;"></i>
                    Active
                </span>
            </div>

            <div class="profile-main">

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


                <div class="doctor-info">
                    <h2>{{ $doctor->doctor_name }}</h2>
                    <p class="clinic-name">
                        <i class="fas fa-hospital me-1"></i>
                        {{ $doctor->clinic_name }}
                    </p>
                    <div class="meta">
                        <span><i class="fas fa-stethoscope"></i>{{ $doctor->category }}</span>
                        <span><i class="fas fa-id-badge"></i>ID: {{ $doctor->id }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="profile-body">
            <div class="body-grid">
                <!-- Left: Details -->
                <div class="card-sub">
                    <h5><i class="fas fa-info-circle"></i>Profile details</h5>
                    <ul class="info-list">
                        <li>
                            <span class="info-label">Clinic / Hospital</span>
                            <span class="info-value">{{ $doctor->clinic_name }}</span>
                        </li>
                        <li>
                            <span class="info-label">Doctor name</span>
                            <span class="info-value">{{ $doctor->doctor_name }}</span>
                        </li>
                        <li>
                            <span class="info-label">Specialty</span>
                            <span class="info-value">{{ $doctor->category }}</span>
                        </li>
                        <li>
                            <span class="info-label">Contact number</span>
                            <span class="info-value">{{ $doctor->contact_number }}</span>
                        </li>
                        <li>
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $doctor->email }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Right: Contact / Actions -->
                <div class="card-sub">
                    <h5><i class="fas fa-phone-volume"></i>Contact & actions</h5>
                    <ul class="contact-list mb-3">
                        <li>
                            <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div style="font-size:0.8rem;color:#6b7280;">Email</div>
                                <div>{{ $doctor->email }}</div>
                            </div>
                        </li>
                        <li>
                            <div class="contact-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <div style="font-size:0.8rem;color:#6b7280;">Phone</div>
                                <div>{{ $doctor->contact_number }}</div>
                            </div>
                        </li>
                    </ul>

                    <div class="d-flex flex-wrap gap-2">
                        <a href="mailto:{{ $doctor->email }}" class="btn-soft btn-soft-primary">
                            <i class="fas fa-paper-plane"></i> Email doctor
                        </a>
                        <a href="tel:{{ $doctor->contact_number }}" class="btn-soft">
                            <i class="fas fa-phone-alt"></i> Call clinic
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="profile-footer">
            <div style="font-size:0.8rem;color:#6b7280;">
                Last updated: {{ optional($doctor->updated_at)->format('d M Y, H:i') }}
            </div>
            <div class="footer-actions">
                <a href="{{ route('doctors.profile.edit', $doctor->id) }}" class="btn-soft">
                    <i class="fas fa-pen"></i> Edit profile
                </a>
                <a href="{{ route('doctors.logout') }}" 
                   class="btn-soft btn-logout"
                   onclick="event.preventDefault(); 
                            if(confirm('Are you sure you want to logout?')) {
                                document.getElementById('logout-form').submit();
                            }">
                    <i class="fas fa-power-off"></i> Logout
                </a>
                {{-- HIDDEN LOGOUT FORM --}}
                <form id="logout-form" action="{{ route('doctors.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
