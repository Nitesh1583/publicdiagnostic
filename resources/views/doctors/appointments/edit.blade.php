<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment - {{ $appointment->patient->patient_name ?? 'Patient' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background: #f8f9fa; }
        .edit-container { max-width: 600px; margin: 2rem auto; background: white; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 2rem; }
        .status-badge { padding: 6px 12px; border-radius: 20px; font-size: 14px; font-weight: 500; }
        .btn-custom { border-radius: 10px; padding: 12px 24px; font-weight: 500; }
    </style>
</head>
<body>
    <div class="container">
        <div class="edit-container">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Edit Appointment</h2>
                <a href="{{ route('doctors.dashboard') }}" class="btn btn-secondary btn-custom">
                    ← Back to Dashboard
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Patient Info (read-only) -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Patient:</strong> {{ $appointment->patient->patient_name ?? 'Unknown' }}<br>
                            <strong>ID:</strong> {{ $appointment->patient->patient_id ?? '' }}<br>
                            <strong>Phone:</strong> {{ $appointment->patient->contact_number ?? '' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong> {{ $appointment->appointment_date->format('d/m/Y') }}<br>
                            <strong>Time:</strong> {{ $appointment->appointment_time }}<br>
                            <strong>Current Status:</strong> 
                            <span class="status-badge 
                                @switch($appointment->status)
                                    @case('pending') @case('scheduled') bg-warning text-dark @break
                                    @case('checked-in') bg-info text-white @break
                                    @case('engaged') bg-primary text-white @break
                                    @case('completed') bg-success text-white @break
                                    @default bg-secondary text-white
                                @endswitch
                            ">{{ ucfirst($appointment->status) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Form -->
            <form method="POST" action="{{ route('doctors.appointments.update', $appointment) }}">
                @csrf
                @method('PATCH')
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-select" required>
                        <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                        <option value="checked-in" {{ $appointment->status == 'checked-in' ? 'selected' : '' }}>Check-In</option>
                        <option value="engaged" {{ $appointment->status == 'engaged' ? 'selected' : '' }}>Engaged</option>
                        <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                    @error('status') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Notes</label>
                    <textarea name="notes" rows="4" class="form-control" placeholder="Add visit notes, diagnosis, treatment details...">{{ $appointment->notes }}</textarea>
                    @error('notes') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-custom flex-fill">
                        <i data-lucide="save"></i> Update Status
                    </button>
                    <a href="{{ route('doctors.appointments.index') }}" class="btn btn-outline-secondary btn-custom">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>lucide.createIcons();</script>
</body>
</html>
