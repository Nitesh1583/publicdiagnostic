<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Clinic Dashboard</title>
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('doctors/assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('doctors/assets/css/dashboard-second.css') }}">
  </head>
  <body>
    <!-- Header -->
    <header id="header">
      @include('doctors.header', ['doctor' => $doctor])
    </header>
    <!-- Header -->

    <!-- filter-bar -->
    <section id="filter-bar" class="mb-section">
      <div class="filter-bar-container">
        <div class="container">
          <div class="filter-bar">
            <!-- Date Range -->
            <div class="filter-item">
              <span>01/09/2025 - 30/09/2025</span>
              <i data-lucide="chevron-down"></i>
            </div>

            <!-- Clinic Name -->
            <div class="filter-item">
              <span>Mehta Teeth Care</span>
              <i data-lucide="chevron-down"></i>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- filter-bar -->

    <!-- stats -->
    <section id="stats" class="mb-section">
      <div class="stats-container padding-lr">
        <div class="container">
          <div class="stats-grid">
            <!-- 1. New Patients -->
            <div class="stat-box blue">
              <i data-lucide="user-plus"></i>
              <p class="stat-box-count">{{ $new_patients }} ({{ $total_patients }})</p>
              <p>New Patients</p>
            </div>

            <!-- 2. Patient Visits -->
            <div class="stat-box red">
              <i data-lucide="users"></i>
              <p class="stat-box-count">1</p>
              <p>Patient Visits</p>
            </div>

            <!-- 3. Appointments -->
            <div class="stat-box orange">
              <i data-lucide="calendar"></i>
              <p class="stat-box-count">5</p>
              <p>Appointments</p>
            </div>

            <!-- 4. Missed Appointments -->
            <div class="stat-box green">
              <i data-lucide="calendar-x"></i>
              <p class="stat-box-count">2</p>
              <p>Missed Appointments</p>
            </div>

            <!-- 5. Professional Fees -->
            <div class="stat-box blue">
              <i data-lucide="dollar-sign"></i>
              <p class="stat-box-count">₹5000</p>
              <p>Professional Fees</p>
            </div>

            <!-- 6. Payment Collection -->
            <div class="stat-box red">
              <i data-lucide="wallet"></i>
              <p class="stat-box-count">₹3000</p>
              <p>Payment Collection</p>
            </div>

            <!-- 7. Outstanding Amount -->
            <div class="stat-box orange">
              <i data-lucide="credit-card"></i>
              <p class="stat-box-count">₹2000</p>
              <p>Outstanding Amount</p>
            </div>

            <!-- 8. Expenses -->
            <div class="stat-box green">
              <i data-lucide="trending-down"></i>
              <p class="stat-box-count">₹1000</p>
              <p>Expenses</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- stats -->

    <!-- Tab Bar -->
    <section id="tab-bar-section">
      <div class="tab-bar">
        <div class="tab active" id="menuTab">Menu</div>
        <div class="tab inactive" id="scheduleTab">Schedule</div>
      </div>
    </section>
    <!-- Tab Bar -->

    <!-- Tab Content -->
    <section id="tabContent">
      <!-- Services -->
      <section id="services" class="active mb">
        <div class="services-container container padding-lr">
          <div class="services-heading">
            <h2 class="red-text">Schedule</h2>
            <p>Quick actions and recent modules</p>
          </div>
          <div class="services-items-container">
            <div class="container">
              <div class="services-items-grid">
                <a href="{{ route('doctors.patients.list-all') }}">
                  <div class="services-items-card">
                      <img src="{{ asset('doctors/assets/images/hospitalisation.png') }}" alt="Patients" />
                      <p>Patients</p>
                  </div>
              </a>
                <a href="quickbill.html">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/bill.png') }}" alt="Quick Bill" />
                    <p>Quick Bill</p>
                  </div>
                </a>
                <a href="settings.html">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/parental-control.png') }} " alt="Settings" />
                    <p>Settings</p>
                  </div>
                </a>
                <a href="{{ route('doctors.appointments.index') }}">
                  <div class="services-items-card">
                    <img
                      src="{{ asset('doctors/assets/images/medical-appointment.png') }}"
                      alt="Appointments"
                    />
                    <p>Appointments</p>
                  </div>
                </a>
                <a href="accounts.html">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/budget.png') }}" alt="Accounts" />
                    <p>Accounts</p>
                  </div>
                </a>
                <a href="campaign.html">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/advertising.png') }}" alt="Campaign" />
                  <p>Campaign</p>
                </div>
                </a>
                <a href="reports.html">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/report.png') }}" alt="Reports" />
                  <p>Reports</p>
                </div>
                </a>
                <a href="prescription.html">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/prescription.png') }}" alt="Prescription"/>
                  <p>Prescription</p>
                </div>
                </a>
                <a href="Inventory.html">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/monitoring.png') }}" alt="Inventory" />
                  <p>Inventory</p>
                </div>
                </a>
                <a href="bills.html">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/payment.png') }}" alt="Billing" />
                  <p>Billing</p>
                </div>
                </a>
                <a href="labWork.html">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/laboratory.png') }}" alt="lab-work" />
                    <p>Lab Work</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Services -->

      <!-- Schedule -->
      <section id="schedule" class="mb">
        <div class="schedule-container">
          <div class="container">
            <!-- Tabs -->
            <!-- Tabs with dynamic counts -->
            <div class="schedule_section-tabs">
              <div class="schedule_section-tab {{ $counts['appointments_count'] == 0 ? '' : 'active' }}" data-target="appointments">
                <h3>Appointments</h3>
                <p>{{ $counts['appointments_count'] }}</p>
              </div>
              <div class="schedule_section-tab" data-target="checkin">
                <h3>Check-In</h3>
                <p>{{ $counts['checkin_count'] }}</p>
              </div>
              <div class="schedule_section-tab" data-target="engaged">
                <h3>Engaged</h3>
                <p>{{ $counts['engaged_count'] }}</p>
              </div>
              <div class="schedule_section-tab" data-target="completed">
                <h3>Completed</h3>
                <p>{{ $counts['completed_count'] }}</p>
              </div>
            </div>

            <!-- Tab Contents -->
<div id="appointments" class="schedule_section-tab-content {{ $counts['appointments_count'] > 0 ? 'active' : '' }}">
  @forelse($appointmentsByStatus['appointments'] as $appointment)
    <div class="schedule_section-card">
      <div class="schedule_section-time">
        <div>
          
          <strong>{{ $appointment->appointment_date->format('d/m/Y') }}</strong>
          <br>
          <span class="time-text">{{ $appointment->appointment_time->format('g:i A') }}</span>
        </div>
        <span class="status-badge {{ strtolower($appointment->status) }}">{{ ucfirst($appointment->status) }}</span>
      </div>
      <div class="schedule_section-details">
        <h4>{{ $appointment->patient->patient_name ?? 'Unknown Patient' }} ({{ $appointment->patient->patient_id ?? '' }})</h4>
        <p>{{ $appointment->patient->contact_number ?? '' }}</p>
        <p>{{ $doctor->clinic_name }}</p>
      </div>
      <div class="schedule_section-actions">
        <i data-lucide="more-vertical"></i>
        <a href="{{ route('doctors.appointments.edit', $appointment->id) }}">Add Visit</a>
      </div>
    </div>
  @empty
    <p>No appointments yet.</p>
  @endforelse
</div>


<!-- Check-in tab example -->
<div id="checkin" class="schedule_section-tab-content">
  @forelse($appointmentsByStatus['checkin'] as $appointment)
    <div class="schedule_section-card">
      <div class="schedule_section-time">
  <div>
    <strong>{{ $appointment->appointment_date->format('d/m/Y') }}</strong>
    <br>
    <span class="time-text">{{ $appointment->appointment_time }}</span>
  </div>
  <span class="status-badge {{ strtolower($appointment->status) }}">{{ ucfirst($appointment->status) }}</span>
</div>

      <!-- rest same as above -->
    </div>
  @empty
    <p>No check-ins yet.</p>
  @endforelse
</div>


            <div id="engaged" class="schedule_section-tab-content">
  @forelse($appointmentsByStatus['engaged'] as $appointment)
    <!-- Same structure, status engaged -->
  @empty
    <p>No engaged appointments.</p>
  @endforelse
</div>

<div id="completed" class="schedule_section-tab-content">
  @forelse($appointmentsByStatus['completed'] as $appointment)
    <!-- Same structure, status completed -->
  @empty
    <p>No completed appointments.</p>
  @endforelse
</div>

          </div>
        </div>
      </section>
      <!-- Schedule -->
    </section>
    <!-- Tab Content -->

    <!-- Trial -->
    <footer id="trial">
      <div class="trial-container">
        <p>Trail Period Expire</p>
        <a href="/"><h4>Click Here To Upgrade</h4></a>
      </div>
    </footer>
    <!-- Trial -->

    <!-- Floating Action Button -->
    <button id="fabBtn" class="fab"><i data-lucide="plus"></i></button>
    <!-- Floating Action Button -->

    <!-- FAB Menu -->
    <div class="fab-menu" id="fabMenu">
      <a href="{{ route('doctors.patients.create') }}" class="fab-item">
        <span class="fab-label">Add Patient</span>
        <div class="fab-icon"><i data-lucide="user"></i></div>
      </a>
      <a href="{{ route('doctors.appointments.create') }}" class="fab-item">
        <span class="fab-label">Add Appointment</span>
        <div class="fab-icon"><i data-lucide="calendar"></i></div>
      </a>
      <a href="/clinic/addWalkInForm.html" class="fab-item">
        <span class="fab-label">Add Walk In</span>
        <div class="fab-icon"><i data-lucide="calendar-days"></i></div>
      </a>
      <div class="fab-item add_payment_detail">
        <span class="fab-label">Add Payment</span>
        <div class="fab-icon"><i data-lucide="indian-rupee"></i></div>
      </div>
    </div>

    <!-- Popup Overlay Payment Detail -->
    <div class="add_payment_popup-overlay" id="addPaymentPopup">
      <div class="add_payment_popup-container">
        <!-- Header -->
        <div class="add_payment_popup-header">
          <h2>Payment Details</h2>
          <button class="add_payment_close-btn" id="addPaymentClose">
            <i data-lucide="x" size="32"></i>
          </button>
        </div>

        <!-- Body -->
        <div class="add_payment_popup-body">
          <!-- Search Patient -->
          <div class="add_payment_search-section">
            <input
              type="text"
              class="add_payment_search-input"
              placeholder="Search Patient"
            />
          </div>

          <!-- Clinic -->
          <div class="add_payment_form-group">
            <label>Clinic:</label>
            <div class="add_payment_dropdown-wrapper">
              <select class="add_payment_form-control">
                <option>Guri</option>
                <option>Clinic 2</option>
                <option>Clinic 3</option>
              </select>
            </div>
          </div>

          <!-- Doctor -->
          <div class="add_payment_form-group">
            <label>Doctor:</label>
            <div class="add_payment_dropdown-wrapper">
              <select class="add_payment_form-control">
                <option>Guri Geet</option>
                <option>Dr. Smith</option>
                <option>Dr. Johnson</option>
              </select>
            </div>
          </div>

          <!-- Date -->
          <div class="add_payment_form-group">
            <div class="add_payment_date-wrapper">
              <input
                type="text"
                class="add_payment_form-control"
                value="07/10/2025"
                placeholder="DD/MM/YYYY"
              />
              <i
                data-lucide="calendar"
                class="add_payment_calendar-icon"
                size="20"
              ></i>
            </div>
          </div>

          <!-- Payment Method & Amount -->
          <div class="add_payment_payment-row">
            <div class="add_payment_dropdown-wrapper">
              <select class="add_payment_form-control">
                <option>Cash</option>
                <option>Card</option>
                <option>UPI</option>
                <option>Bank Transfer</option>
              </select>
            </div>
            <input
              type="number"
              class="add_payment_form-control"
              placeholder="Amount"
            />
          </div>

          <!-- Remarks -->
          <div class="add_payment_form-group">
            <label>Remarks:</label>
            <textarea
              class="add_payment_form-control"
              placeholder="Enter remarks..."
            ></textarea>
          </div>

          <!-- Save Button -->
          <button class="add_payment_save-btn">Save</button>
        </div>
      </div>
    </div>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <script src="{{ asset('doctors/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('doctors/assets/js/clinicScript.js') }}"></script>
    <script>
     
    </script>
  </body>
</html>
