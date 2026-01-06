<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Doctors\DoctorsAuthController;
use App\Http\Controllers\Doctors\DoctorsDashboardController;
use App\Http\Controllers\Doctors\DoctorsProfileController;
use App\Http\Controllers\Doctors\SettingsController;

use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Clinic\ClinicsController;

use App\Http\Controllers\Appointment\AppointmentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/db-check', function () {
    try {
        $result = DB::select('SELECT 1');
        return "Database connected successfully ";
    } catch (\Exception $e) {
        return "Database connection failed : " . $e->getMessage();
    }
});

Route::prefix('admin')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');

    // ADMIN AUTH ROUTES
    Route::middleware(['auth'])->group(function () {
        
        // ADMIN DASHBOARD ROUTE
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

        //ADMIN PROFILE ROUTES
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');

        Route::post('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

        Route::post('/profile/password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('admin.profile.password');

        // ADMIN LOGOUT ROUTE
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    });

});

Route::prefix('clinic/doctors')->group(function () {

    // public: register + login
    Route::get('/register', [DoctorsAuthController::class, 'create'])
    ->name('doctor.register.create');
    
    Route::post('/register', [DoctorsAuthController::class, 'store'])
        ->name('doctor.register.store');

    Route::get('/login', [DoctorsAuthController::class, 'showLoginForm'])
        ->name('doctors.login.show');
    Route::post('/login', [DoctorsAuthController::class, 'login'])
        ->name('doctors.login');

    // Header route - ADD THIS
    Route::get('/header', function () {
        $doctor = session('doctor_id') ? App\Models\Doctors::find(session('doctor_id')) : null;
        return view('doctors.header', compact('doctor'));
    })->name('doctors.header');

    // protected: only logged-in doctors
    Route::middleware(['doctors'])->group(function () {
        
        Route::get('/dashboard', [DoctorsDashboardController::class, 'index'])
            ->name('doctors.dashboard');

        Route::get('/{id}/profile', [DoctorsProfileController::class, 'show'])
        ->name('doctors.profile.show');

          Route::get('/{id}/profile/edit', [DoctorsProfileController::class, 'edit'])
        ->name('doctors.profile.edit');
        
        Route::put('/{id}/profile', [DoctorsProfileController::class, 'update'])
        ->name('doctors.profile.update');
        
        Route::post('/logout', [DoctorsAuthController::class, 'logout'])
            ->name('doctors.logout');


        // Patients Routes
        Route::get('/patients/create', [PatientController::class, 'create'])->name('doctors.patients.create');
        Route::post('/patients', [PatientController::class, 'store'])->name('doctors.patients.store');

        Route::get('/patients/list-all', [PatientController::class, 'patientsList'])->name('doctors.patients.list-all');

        Route::get('/patients', [PatientController::class, 'patientsList'])->name('doctors.patients.list');


        //Appointments Routes
        Route::get('/appointments', [AppointmentController::class, 'index'])->name('doctors.appointments.index');
        
        Route::get('/appointments/create', [AppointmentController::class, 'create'])->name('doctors.appointments.create');
        
        Route::post('/appointments', [AppointmentController::class, 'store'])->name('doctors.appointments.store');


        //Appointments Edit Routes
        Route::get('/appointments/{appointment}/edit', [AppointmentController::class, 'edit'])->name('doctors.appointments.edit');
        
        Route::patch('/appointments/{appointment}', [AppointmentController::class, 'update'])->name('doctors.appointments.update');


        Route::get('/settings', [SettingsController::class, 'index'])->name('doctors.settings');

        Route::get('/clinics', [ClinicsController::class, 'index'])->name('doctor.clinics.index');
    });
});
