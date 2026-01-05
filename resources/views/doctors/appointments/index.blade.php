<!DOCTYPE html>
<html lang="en">
<head>
    <title>Appointments Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('appointments/assets/css/index.css') }}">
</head>
<body>
    <div class="calendar-container">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-calendar-alt me-3"></i>Appointments Calendar</h1>
                    <p class="mb-0">Total: {{ $appointments->total() }} appointments</p>
                </div>
                <div class="col-md-4 text-end">
                    <a href="{{ route('doctors.appointments.create') }}" class="btn btn-light btn-lg">
                        <i class="fas fa-plus me-2"></i>New Appointment
                    </a>
                </div>
            </div>
        </div>

        <div class="card shadow-lg mb-4">
            <div class="card-body p-0">
                <div class="calendar-grid">
                    <div class="calendar-header text-center py-3">
                        <i class="fas fa-chevron-left me-2 clickable" onclick="changeMonth(-1)"></i>
                        <strong id="currentMonth">{{ now()->format('F Y') }}</strong>
                        <i class="fas fa-chevron-right ms-2 clickable" onclick="changeMonth(1)"></i>
                    </div>
                    @foreach(['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'] as $day)
                        <div class="calendar-header text-center py-3">{{ $day }}</div>
                    @endforeach

                    @php
                        $start = now()->startOfMonth()->startOfWeek();
                        $end = now()->endOfMonth()->endOfWeek();
                        $appointmentsByDate = $appointments->groupBy(function($a) { return $a->appointment_date->format('Y-m-d'); });
                    @endphp

                    @for($i = 0; $i < 42; $i++)
                        @php
                            $date = $start->copy()->addDays($i);
                            $dateKey = $date->format('Y-m-d');
                            $dayAppointments = $appointmentsByDate->get($dateKey, collect());
                            $isToday = $date->isToday();
                            $isPast = $date->lt(now());
                        @endphp

                        <div class="calendar-cell {{ $isToday ? 'today' : '' }} {{ $dayAppointments->count() ? 'appointment' : '' }} {{ $isPast ? 'past' : '' }}"
                             @if(!$isPast) onclick="bookAppointment('{{ $dateKey }}')" @endif
                             data-date="{{ $dateKey }}">
                            
                            <div class="fw-bold mb-2">{{ $date->format('j') }}</div>
                            
                            @if($dayAppointments->count())
                                @foreach($dayAppointments->take(3) as $appt)
                                    <div class="appointment-item">
                                        <div class="appointment-name">{{ Str::limit($appt->patient->patient_name ?? 'Unknown', 12) }}</div>
                                        <small class="appointment-time">{{ $appt->appointment_time->format('g:i A') }}</small>
                                    </div>
                                @endforeach
                                @if($dayAppointments->count() > 3)
                                    <small>+{{ $dayAppointments->count() - 3 }} more</small>
                                @endif
                            @endif

                            @if(!$isPast)
                                <button class="add-appointment-btn" onclick="event.stopPropagation(); bookAppointment('{{ $dateKey }}')">
                                    <i class="fas fa-plus text-success"></i>
                                </button>
                            @endif
                        </div>
                    @endfor

                </div>
            </div>
        </div>

        @if($appointments->hasPages())
            <div class="mt-4">
                {{ $appointments->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function bookAppointment(date) {
            if (confirm('Book new appointment for ' + new Date(date).toLocaleDateString('en-IN') + '?')) {
                
                // window.location.href = `/doctors/appointments/create?date=${date}`;
                window.location.href = "{{ route('doctors.appointments.create')}}";
            }
        }

        function changeMonth(direction) {
            // Simple month navigation (reloads page for demo)
            const d = new Date();
            d.setMonth(d.getMonth() + direction);
            window.location.href = window.location.pathname + '?month=' + d.toISOString().slice(0,7);
        }

        document.querySelectorAll('.clickable').forEach(el => {
            el.style.cursor = 'pointer';
        });
    </script>
</body>
</html>
