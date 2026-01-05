<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctors;
use Illuminate\Support\Facades\Hash;
use Auth;

class DoctorsAuthController extends Controller
{
    // DOCTORS VIEW PAGE FUNCTION =======>
    public function create()
    {
        return view('doctors.auth.register');
    }

    // DOCTORS REGISTER FUNCTON WORK ===========>
    public function store(Request $request)
    {
        $request->validate([
            'clinic_name'    => 'required|string|max:255',
            'doctor_name'    => 'required|string|max:255',
            'email'          => 'required|email|max:255|unique:doctors,email',
            'password'       => 'required|min:8|confirmed',
            'contact_number' => 'required|string|max:20',
            'category'       => 'required|string|max:255',
        ]);

        Doctors::create([
            'clinic_name'    => $request->clinic_name,
            'doctor_name'    => $request->doctor_name,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'category'       => $request->category,
        ]);

        return redirect()->route('doctors.login.show')
        ->with('success', 'Clinic registered. Please Login.');
    }


    // DOCTORS LOGIN PAGE VIEW FUNCTION ===========>
    public function showLoginForm()
    {
        return view('doctors.auth.login');
    }

    // DOCTORS LOGIN AUTH FUNCTION WORK ============>
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('doctors')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('doctors.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials',
        ]);
    }

    // DOCTORS LOGOUT WORKS ================>
    public function logout(Request $request)
    {
        $request->session()->forget('doctor_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('doctors.login.show');
    }
}

