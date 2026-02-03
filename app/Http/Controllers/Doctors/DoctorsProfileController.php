<?php

namespace App\Http\Controllers\Doctors;

use App\Http\Controllers\Controller;
use App\Models\Doctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\Hash;

class DoctorsProfileController extends Controller
{
    public function show($id)
    {
        $doctor = Doctors::findOrFail($id);
        return view('doctors.doctorsprofile', compact('doctor'));
    }

    public function edit($id)
    {
        $doctor = Doctors::findOrFail($id);
        return view('doctors.doctorsprofile-edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctors::findOrFail($id);
        
        $request->validate([
            'doctor_name' => 'required|string|max:255',
            'business_category' => 'required|string|max:255',
            'email' => 'required|email|unique:doctors,email,' . $id,
            'contact_number' => 'required|string|max:20',
            'category' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_password' => 'required',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $data = $request->only(['doctor_name', 'business_category', 'email', 'contact_number', 'category']);

        // PASSWORD CHANGE LOGIC
        if ($request->filled('password')) {
            // Verify current password
            if (!Hash::check($request->current_password, $doctor->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            
            $data['password'] = Hash::make($request->password);
        }

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($doctor->photo) {
                Storage::disk('public')->delete($doctor->photo);
            }
            $data['photo'] = trim($request->file('photo')->store('doctor-photos', 'public'));
        }

        $doctor->update($data);

        return redirect()->route('doctors.profile.show', $id)
            ->with('success', 'Profile updated successfully!');
    }
}
