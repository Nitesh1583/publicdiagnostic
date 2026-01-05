<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
</head>
<body>

<div class="app">
    {{-- LEFT SIDEBAR --}}
    <aside class="sidebar">
        <div class="logo-row">
            <div class="logo-icon">❤</div>
            <span class="logo-text">Administrator</span>
        </div>

        <!-- <button class="help-btn">
            <span class="mic-icon">🎙</span>
            <span>Emergency help</span>
        </button> -->

        <nav class="menu">
            <div class="menu-group">
                <div class="menu-label">Main</div>
                <a href="#" class="menu-item active">
                    <span class="menu-icon">🏠</span>
                    <span>Dashboard</span>
                    <span class="menu-pill">1</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📅</span>
                    <span>Appointments</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">🧑‍⚕️</span>
                    <span>Patients</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">👨‍⚕️</span>
                    <span>Doctors</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📄</span>
                    <span>Reports</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">💳</span>
                    <span>Billing</span>
                </a>
                <a href="#" class="menu-item">
                    <span class="menu-icon">📦</span>
                    <span>Inventory</span>
                </a>

                <a href="{{ route('admin.logout') }}"
                   class="menu-item menu-item-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span class="menu-icon">↩</span>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </nav>

        <div class="promo-card">
            <img src="{{ asset('admin/assets/images/doc-illustration.png') }}" alt="">
            <div class="promo-text">
                <div class="promo-title">Make an Appointments</div>
                <div class="promo-subtitle">Best health care here</div>
            </div>
        </div>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="main">
        {{-- TOP BAR --}}
        <header class="topbar">
            <div class="topbar-left">
                <button class="icon-btn"><span>☰</span></button>
                <div class="search-box">
                    <span class="search-icon">🔍</span>
                    <input type="text" placeholder="Search">
                </div>
            </div>
            <div class="topbar-right">
                <button class="icon-btn">⛶</button>
                <button class="icon-btn">🔔</button>
                <button class="icon-btn">⚙</button>
                
                <a href="{{ route('admin.profile.edit') }}" class="user-chip">
                    {{-- <img src="{{ asset('admin/assets/images/doctor-avatar.png') }}" alt=""> --}}
                    <div class="user-meta">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">Admin</div>
                    </div>
                </a>

            </div>
        </header>

        {{-- CONTENT GRID --}}
        <section class="grid">

            {{-- STAT CARDS --}}
            <div class="card stat-card">
                <div class="stat-icon stat-patients"></div>
                <div class="stat-label">Total Patients</div>
                <div class="stat-value">1,548</div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon stat-consult"></div>
                <div class="stat-label">Consultation</div>
                <div class="stat-value">448</div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon stat-staff"></div>
                <div class="stat-label">Staff</div>
                <div class="stat-value">848</div>
            </div>

            <div class="card stat-card">
                <div class="stat-icon stat-rooms"></div>
                <div class="stat-label">Total Rooms</div>
                <div class="stat-value">3,100</div>
            </div>

            {{-- DAILY REVENUE --}}
            <div class="card big-card">
                <div class="card-header">
                    <span>Daily Revenue Report</span>
                </div>
                <div class="revenue-amount">
                    <span class="main">$32,485</span>
                    <span class="sub">$12,458</span>
                </div>
                <canvas id="revenueChart"></canvas>
            </div>

            {{-- PAYMENTS HISTORY --}}
            <div class="card big-card">
                <div class="card-header">
                    <span>Payments history</span>
                </div>
                <ul class="list">
                    <li>
                        <div>
                            <div class="list-title">Dr. Johen Doe</div>
                            <div class="list-sub">Kidney function test • Sunday, 16 May</div>
                        </div>
                        <div class="list-amount">$25.15</div>
                    </li>
                    <li>
                        <div>
                            <div class="list-title">Dr. Michael Doe</div>
                            <div class="list-sub">Emergency appointment • Sunday, 16 May</div>
                        </div>
                        <div class="list-amount">$99.15</div>
                    </li>
                </ul>
            </div>

            {{-- UPCOMING APPOINTMENTS (RIGHT COLUMN TOP) --}}
            <div class="card side-card">
                <div class="card-header">
                    <span>Upcoming Appointments</span>
                </div>
                <div class="calendar-strip">
                    <button>&lt;</button>
                    <div class="day">
                        <div class="day-name">Wed</div>
                        <div class="day-date">4th May 2022</div>
                    </div>
                    <button>&gt;</button>
                </div>
                <ul class="appointment-list">
                    <li>
                        <div class="avatar"></div>
                        <div class="info">
                            <div class="name">Shawn Hampton</div>
                            <div class="desc">Emergency appointment</div>
                            <div class="meta">10:00 • $30</div>
                        </div>
                    </li>
                    <!-- Repeat more items -->
                </ul>
            </div>

            {{-- DOCTOR LIST --}}
            <div class="card big-card">
                <div class="card-header">
                    <span>Doctor List</span>
                    <span class="muted">Today</span>
                </div>
                <ul class="doctor-list">
                    <li>
                        <div class="avatar"></div>
                        <div class="info">
                            <div class="name">Dr. Jaylon Stanton</div>
                            <div class="role">Dentist</div>
                        </div>
                    </li>
                    <!-- Repeat -->
                </ul>
            </div>

            {{-- BALANCE --}}
            <div class="card">
                <div class="card-header">
                    <span>Balance</span>
                </div>
                <div class="balance-row">
                    <div class="balance-pill income">
                        <span>Income</span>
                        <strong>$142K</strong>
                    </div>
                    <div class="balance-pill outcome">
                        <span>Outcome</span>
                        <strong>$43K</strong>
                    </div>
                </div>
                <canvas id="balanceChart"></canvas>
            </div>

            {{-- APPOINTMENTS OVERVIEW PIE --}}
            <div class="card">
                <div class="card-header">
                    <span>Appointments Overview</span>
                </div>
                <canvas id="appointmentsPie"></canvas>
            </div>

        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('admin/assets/js/dashboard.js') }}"></script>

</body>
</html>
