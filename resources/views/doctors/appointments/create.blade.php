<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Appointment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body style="font-family: 'Poppins', sans-serif; background: #f8f9fa;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-success text-white text-center py-4">
                        <h3><i class="fas fa-calendar-plus me-3"></i>New Appointment</h3>
                    </div>
                    <div class="card-body p-5">
                        <form method="POST" action="{{ route('doctors.appointments.store') }}">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-bold">Patient <span class="text-danger">*</span></label>
                                    <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
                                        <option value="">Select Patient</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" 
                                                    {{ old('patient_id', $preselectedPatient) == $patient->id ? 'selected' : '' }}>
                                                {{ $patient->patient_name }} ({{ $patient->patient_id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-3 mb-4">
                                    <label class="form-label fw-bold">Date <span class="text-danger">*</span></label>
                                    <input type="date" name="appointment_date" 
                                           class="form-control @error('appointment_date') is-invalid @enderror" 
                                           value="{{ old('appointment_date', $preselectedDate) }}" required min="{{ now()->format('Y-m-d') }}">
                                    @error('appointment_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                
                                <div class="col-md-3 mb-4">
                                    <label class="form-label fw-bold">Time <span class="text-danger">*</span></label>
                                    <input type="time" name="appointment_time" 
                                           class="form-control @error('appointment_time') is-invalid @enderror" 
                                           value="{{ old('appointment_time', $preselectedTime) }}" required>
                                    @error('appointment_time') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Notes</label>
                                <textarea name="notes" rows="4" class="form-control @error('notes') is-invalid @enderror" 
                                          placeholder="Any special instructions...">{{ old('notes') }}</textarea>
                            </div>
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="{{ route('doctors.appointments.index') }}" class="btn btn-outline-secondary btn-lg">
                                    <i class="fas fa-arrow-left me-2"></i>Back to Calendar
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>Book Appointment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>