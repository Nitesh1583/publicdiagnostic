<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Doctor Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('doctors/assets/css/doctorseditprofile.css') }}">
</head>
<body>
<div class="profile-wrapper">
    <a href="{{ route('doctors.profile.show', $doctor->id) }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Back to profile
    </a>

    <div class="profile-card">
        <div class="profile-header">
            <h2><i class="fas fa-user-edit me-2"></i>Edit Profile</h2>
            <p>Update your clinic and personal information</p>
        </div>

        <div class="profile-body">
            @if(session('success'))
                <div class="success-alert">{{ session('success') }}</div>
            @endif

            <form action="{{ route('doctors.profile.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="form-grid">
                    <div class="form-group">
                        <label for="doctor_name">Doctor Full Name</label>
                        <input type="text" id="doctor_name" name="doctor_name" 
                               value="{{ old('doctor_name', $doctor->doctor_name) }}" required>
                        @error('doctor_name') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="business_category">Business Category</label>
                        <select id="business_category" name="business_category" required>
                            <option value="{{ old('business_category', $doctor->business_category) }}" selected>{{ old('business_category', $doctor->business_category) }}</option>
                        </select>
                        @error('business_category') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" 
                               value="{{ old('email', $doctor->email) }}" required>
                        @error('email') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="contact_number">Contact Number</label>
                        <input type="tel" id="contact_number" name="contact_number" 
                               value="{{ old('contact_number', $doctor->contact_number) }}" required>
                        @error('contact_number') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Specialty</label>
                        <select id="category" name="category" required>
                            <option value="General Physician, {{ old('category', $doctor->category) == 'General Physician' ? 'selected' : '' }}">General Physician</option>
                            <option value="Cardiologist, {{ old('category', $doctor->category) == 'Cardiologist' ? 'selected' : '' }}">Cardiologist</option>
                            <option value="Orthopedic, {{ old('category', $doctor->category) == 'Orthopedic' ? 'selected' : '' }}">Orthopedic</option>
                            <option value="Pediatrician, {{ old('category', $doctor->category) == 'Pediatrician' ? 'selected' : '' }}">Pediatrician</option>
                            <option value="Dentist, {{ old('category', $doctor->category) == 'Dentist' ? 'selected' : '' }}">Dentist</option>
                            <option value="Other, {{ old('category', $doctor->category) == 'Other' ? 'selected' : '' }}">Other</option>
                        </select>
                        @error('category') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
    
                    {{-- NEW: PASSWORD SECTION --}}
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" id="current_password" name="current_password">
                        @error('current_password') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" id="password" name="password" minlength="8">
                        @error('password') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation') <div class="error-text">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label>Profile Photo</label>
                        <div class="photo-upload" onclick="document.getElementById('photo').click()">
                            <i class="fas fa-camera"></i>
                            <h6>Upload new photo</h6>
                            <p class="text-muted mb-0 small">PNG, JPG (Max 2MB) - Optional</p>
                            @if($doctor->photo)
                                <img src="{{ asset('storage/' . $doctor->photo) }}" class="photo-preview" alt="Current photo">
                            @endif
                        </div>
                        <input type="file" id="photo" name="photo" class="d-none" accept="image/*">
                        @error('photo') <div class="error-text">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('doctors.profile.show', $doctor->id) }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('doctors/assets/js/doctorseditprofile.js') }}"></script>
</body>
</html>
