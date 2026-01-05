<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patients List</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('patients/assets/css/patient-list.css') }}">
    
</head>
<body>
    <div class="patients-container">
        <!-- Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-users me-3"></i>All Patients</h1>
                    <p class="mb-0">Total: {{ $patients->total() }} patients</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('doctors.patients.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>Add New Patient
                    </a>
                </div>
            </div>
        </div>

        <!-- Search & Filter Section -->
        <div class="search-section">
            <form method="GET" action="{{ route('doctors.patients.list') }}" class="row g-3 align-items-end">
                <!-- Search Bar -->
                <div class="col-md-5">
                    <label class="form-label fw-bold">Search Patients</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" 
                               name="search" 
                               class="form-control" 
                               placeholder="Name, Patient ID, Phone, Clinic..." 
                               value="{{ request('search') }}">
                        <button class="btn btn-danger" type="submit">
                            <i class="fas fa-search me-1"></i>Search
                        </button>
                    </div>
                    @if(request('search'))
                        <small class="text-muted">Showing results for: "{{ request('search') }}"</small>
                    @endif
                </div>

                <!-- Gender Filter -->
                <div class="col-md-3">
                    <label class="form-label fw-bold">Filter by Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">All Genders</option>
                        <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ request('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fas fa-filter me-1"></i>Filter
                    </button>
                    <a href="{{ route('doctors.patients.list') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-refresh me-1"></i>Clear All
                    </a>
                </div>
            </form>
        </div>

        <!-- Patients Table -->
        <div class="card shadow-lg">
            <div class="card-body p-0">
                @if($patients->count() > 0)
                    <!-- Search Results Info -->
                    @if(request('search') || request('gender'))
                        <div class="p-3 bg-light border-bottom">
                            <div class="search-results">
                                @if(request('search'))
                                    <i class="fas fa-search me-2"></i>
                                    Found {{ $patients->total() }} patient{{ $patients->total() != 1 ? 's' : '' }} for "{{ request('search') }}"
                                @endif
                                @if(request('gender'))
                                    <i class="fas fa-venus-mars ms-3 me-2"></i>
                                    {{ ucfirst(request('gender')) }} patients
                                @endif
                            </div>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th><i class="fas fa-hashtag me-1"></i>ID</th>
                                    <th><i class="fas fa-user me-1"></i>Name</th>
                                    <th><i class="fas fa-venus-mars me-1"></i>Gender</th>
                                    <th><i class="fas fa-calendar me-1"></i>DOB</th>
                                    <th><i class="fas fa-phone me-1"></i>Contact</th>
                                    <th><i class="fas fa-clock me-1"></i>Created</th>
                                    <th><i class="fas fa-ellipsis-h"></i>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                    @php
                                        $payload = [
                                            'id'               => $patient->id,
                                            'patient_id'       => $patient->patient_id,
                                            'patient_name'     => $patient->patient_name,
                                            'gender'           => $patient->gender,
                                            'dob'              => $patient->dob,
                                            'contact_number'   => $patient->contact_number,
                                            'created_at'       => $patient->created_at,
                                            'email'            => $patient->email,
                                            'clinic_name'      => $patient->clinic_name,
                                            'emergency_contact'=> $patient->emergency_contact,
                                            'blood_group'      => $patient->blood_group,
                                            'address'          => $patient->address,
                                            'illness'          => $patient->illness,
                                            'allergies'        => $patient->allergies,
                                            'habits'           => $patient->habits,
                                            'medical_history'  => $patient->medical_history,
                                            'attachments'      => $patient->attachments,
                                        ];
                                    @endphp
                                    <tr>
                                        <td><strong>{{ $patient->patient_id }}</strong></td>
                                        <td>{{ $patient->patient_name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $patient->gender == 'Male' ? 'primary' : ($patient->gender == 'Female' ? 'danger' : 'secondary') }}">
                                                {{ $patient->gender }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($patient->dob)->format('d M Y') }}</td>
                                        <td>{{ $patient->contact_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($patient->created_at)->format('d M Y') }}</td>
                                        <td>
                                            <button class="btn btn-details btn-sm text-white" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#patientModal"
                                                    data-patient='@json($payload)'>
                                                <i class="fas fa-eye me-1"></i>Details
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-muted mb-4"></i>
                        <h3>@if(request('search')) No patients found @else No patients found @endif</h3>
                        <p class="text-muted">
                            @if(request('search'))
                                Try different search terms or 
                            @endif
                            start by adding your first patient
                        </p>
                        <a href="{{ route('doctors.patients.create') }}" class="btn btn-primary btn-lg">
                            <i class="fas fa-plus me-2"></i>Add First Patient
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Pagination -->
        @if($patients->hasPages())
            <div class="mt-4">
                {{ $patients->appends(request()->only(['search', 'gender']))->links() }}
            </div>
        @endif
    </div>

    <!-- Patient Details Modal (same as before) -->
    <div class="modal fade" id="patientModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user me-2"></i><span id="modalPatientName"></span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="patientDetails"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('patients/assets/js/patient-list.js') }}"></script>
</body>
</html>
