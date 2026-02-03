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

    <style>
      .filter-item {
        position: relative;cursor: pointer;display: inline-flex;align-items: center;gap: 8px;
        padding: 8px 12px;border: 1px solid #ddd;border-radius: 6px;background: white;
        transition: all 0.2s;
      }

      .filter-item:hover {  border-color: #007bff; }
      .toggle-icon {  transition: transform 0.2s; }
      .dropdown-open .toggle-icon { transform: rotate(180deg);  }

      .month-selector-dropdown {
        position: absolute;top: 100%;left: 0;right: 0;margin-top: 4px;background: white;
        border: 1px solid #ddd;border-radius: 6px;box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 1000;padding: 12px;
      }

      .month-nav {
        display: flex;align-items: center;justify-content: space-between;gap: 12px;margin-bottom: 8px;
      }

      .nav-btn {
        background: #007bff;color: white;border: none;padding: 6px 12px;border-radius: 4px;
        cursor: pointer;font-size: 14px;
      }

      .nav-btn:hover {  background: #0056b3;  }

      .current-month {  font-weight: 600; font-size: 16px;  }
    </style>
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

            <!-- Clinic Name -->
            <div class="filter-item">
                <select name="clinic_filter" id="clinicFilter" class="clinic-select form-select">
                    <option value="">All Clinics ({{ $clinicCount }})</option>
                    @foreach($clinics as $clinic)
                        <option value="{{ $clinic->id }}" {{ request('clinic_filter') == $clinic->id ? 'selected' : '' }}>
                            {{ $clinic->clinic_name }}
                        </option>
                    @endforeach
                </select>
                <i data-lucide="chevron-down" class="clinic-dropdown-icon"></i>
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
                @if($clinicCount > 0)
                  <a href="{{ route('doctors.patients.list-all') }}">
                      <div class="services-items-card">
                          <img src="{{ asset('doctors/assets/images/hospitalisation.png') }}" alt="Patients" />
                          <p>Patients</p>
                      </div>
                  </a>
                @else
                  <div class="services-items-card" onclick="showClinicMessage()">
                    <img src="{{ asset('doctors/assets/images/hospitalisation.png') }}" alt="Patients" />
                    <p>Patients</p>
                  </div>
                @endif

                <a href="#">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/bill.png') }}" alt="Quick Bill" />
                    <p>Quick Bill</p>
                  </div>
                </a>
                <a href="{{ route('doctors.settings') }}">
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
                <a href="#">
                  <div class="services-items-card">
                    <img src="{{ asset('doctors/assets/images/budget.png') }}" alt="Accounts" />
                    <p>Accounts</p>
                  </div>
                </a>
                <a href="#">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/advertising.png') }}" alt="Campaign" />
                  <p>Campaign</p>
                </div>
                </a>
                <a href="#">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/report.png') }}" alt="Reports" />
                  <p>Reports</p>
                </div>
                </a>
                <a href="#">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/prescription.png') }}" alt="Prescription"/>
                  <p>Prescription</p>
                </div>
                </a>
                <a href="#">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/monitoring.png') }}" alt="Inventory" />
                  <p>Inventory</p>
                </div>
                </a>
                <a href="#">
                <div class="services-items-card">
                  <img src="{{ asset('doctors/assets/images/payment.png') }}" alt="Billing" />
                  <p>Billing</p>
                </div>
                </a>
                <a href="#">
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
            <div id="appointments" class="schedule_section-tab-content 
              {{ $counts['appointments_count'] > 0 ? 'active' : '' }}">
              
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
      function showClinicMessage() {
        const message = document.createElement('div');
        message.id = 'clinic-message';
        message.style.cssText = `
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background: white;
          padding: 30px 40px;
          border-radius: 12px;
          box-shadow: 0 20px 40px rgba(0,0,0,0.3);
          z-index: 10000;
          max-width: 400px;
          text-align: center;
          font-size: 16px;
          font-weight: 500;
          color: #374151;
          border: 2px solid #e5e7eb;
        `;
        
        message.innerHTML = `
          <div style="margin-bottom: 20px; font-size: 20px; color: #dc2626;">
              ⏸️ Clinic Required
          </div>
          <div style="margin-bottom: 25px; line-height: 1.5;">
              Please add first clinic before accessing patients.
          </div>
          <a href="{{ route('doctors.clinics.create') }}" 
             style="
                 display: inline-block;
                 padding: 12px 28px;
                 background: #3b82f6;
                 color: white;
                 text-decoration: none;
                 border-radius: 8px;
                 font-weight: 500;
                 font-size: 15px;
                 transition: background 0.2s;
             "
             onmouseover="this.style.background='#2563eb'"
             onmouseout="this.style.background='#3b82f6'">
              Click here to add your clinic
          </a>
        `;
          
        document.body.appendChild(message);
        document.body.style.overflow = 'hidden';
          
        // Auto-close after 8 seconds
        setTimeout(() => {
            if (document.getElementById('clinic-message')) {
                document.getElementById('clinic-message').remove();
                document.body.style.overflow = 'auto';
            }
        }, 5000);
          
        // Close when clicking outside popup
        message.addEventListener('click', function(e) {
            if (e.target === this) {
                this.remove();
                document.body.style.overflow = 'auto';
            }
        });
      }

      //Date Range
      document.addEventListener('DOMContentLoaded', function() {
        const filters = document.querySelectorAll('.date-range-filter');
      
        filters.forEach(filter => {
          const display = filter.querySelector('.date-display');
          const dropdown = filter.querySelector('.month-selector-dropdown');
          const toggleIcon = filter.querySelector('.toggle-icon');
          const prevBtn = filter.querySelector('.prev-month');
          const nextBtn = filter.querySelector('.next-month');
          const monthSpan = filter.querySelector('.current-month');
          const dateFrom = filter.querySelector('.date-from');
          const dateTo = filter.querySelector('.date-to');
          
          let currentDate = new Date();
          const initialDateStr = filter.dataset.currentDate;
          if (initialDateStr) {
            currentDate = new Date(initialDateStr);
          }
        
          function updateDisplay() {
            const year = currentDate.getFullYear();
            const month = (currentDate.getMonth() + 1).toString().padStart(2, '0');
            const daysInMonth = new Date(year, currentDate.getMonth() + 1, 0).getDate();
            const fromDate = `01/${month}/${year}`;
            const toDate = `${daysInMonth.toString().padStart(2, '0')}/${month}/${year}`;
            
            display.textContent = `${fromDate} - ${toDate}`;
            dateFrom.value = `${year}-${month}-01`;
            dateTo.value = `${year}-${month}-${daysInMonth.toString().padStart(2, '0')}`;
            monthSpan.textContent = currentDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
          }
        
          function toggleDropdown() {
            const isOpen = filter.classList.contains('dropdown-open');
            if (isOpen) {
              filter.classList.remove('dropdown-open');
              dropdown.style.display = 'none';
            } else {
              filter.classList.add('dropdown-open');
              dropdown.style.display = 'block';
            }
          }
        
          function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            updateDisplay();
          }
          
          function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            updateDisplay();
          }
          
          // Event listeners
          filter.addEventListener('click', toggleDropdown);
          prevBtn.addEventListener('click', prevMonth);
          nextBtn.addEventListener('click', nextMonth);
          
          // Close dropdown when clicking outside
          document.addEventListener('click', function(e) {
            if (!filter.contains(e.target)) {
              filter.classList.remove('dropdown-open');
              dropdown.style.display = 'none';
            }
          });
        
          // Initial update
          updateDisplay();
        });
      });
    </script>
  </body>
</html>

