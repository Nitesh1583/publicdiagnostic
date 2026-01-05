<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor / Clinic Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('doctors/assets/css/style.css') }}">

</head>
<body>
<div class="wrapper">
    <h1>Register your clinic</h1>
    <p class="subtitle">
        Doctors can submit clinic details here to join the Public Diagnostic network.
    </p>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('doctor.register.store') }}">
        @csrf

        <div class="form-grid">
            <div class="form-group">
                <label for="clinic_name">Clinic / Hospital name</label>
                <input id="clinic_name" name="clinic_name" type="text"
                       value="{{ old('clinic_name') }}" required>
                @error('clinic_name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="doctor_name">Doctor full name</label>
                <input id="doctor_name" name="doctor_name" type="text"
                       value="{{ old('doctor_name') }}" required>
                @error('doctor_name') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="email">Contact email</label>
                <input id="email" name="email" type="email"
                       value="{{ old('email') }}" required>
                @error('email') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="contact_number">Contact number</label>
                <input id="contact_number" name="contact_number" type="text"
                       value="{{ old('contact_number') }}" required>
                @error('contact_number') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group" style="grid-column: span 2;">
                <label for="category">Doctor category / specialty</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select category</option>
                    <option value="General Physician">General Physician</option>
                    <option value="Cardiologist">Cardiologist</option>
                    <option value="Orthopedic">Orthopedic</option>
                    <option value="Pediatrician">Pediatrician</option>
                    <option value="Dentist">Dentist</option>
                    <option value="Other">Other</option>
                </select>
                @error('category') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Create password</label>
                <input id="password" name="password" type="password" required>
                @error('password') <div class="error-text">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required>
            </div>
        </div>

        <button type="submit" class="btn-primary">Submit clinic request</button>
    </form>

    <p class="switch-auth">
        Already have an account?
        <a href="{{ route('doctors.login.show') }}" class="link-login">
            Login here
        </a>
    </p>
</div>
</body>
</html>
