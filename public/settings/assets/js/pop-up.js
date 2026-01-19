// Payment Popup Work Starts here ======================>

function openPopup() {
    document.getElementById("paymentPopup").style.display = "flex";
}

function closePopup() {
    document.getElementById("paymentPopup").style.display = "none";
}

// Handle form submit (send to Laravel route/controller)
document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    // AJAX to your Laravel endpoint (e.g., /clinic/{id}/payment-settings)
    fetch('/clinic/payment-settings', {  // Replace with your route
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Settings saved successfully!');
            closePopup();
        } else {
            alert('Error saving settings.');
        }
    })
    .catch(error => console.error('Error:', error));
});

// Payment Popup Work Ends here ======================>


// Notifications Popup Work Starts Here =======================>

function openNotificationModal() {
    document.getElementById("notificationModal").style.display = "flex";
}

function closeNotificationModal() {
    document.getElementById("notificationModal").style.display = "none";
}

// Form submission (to your Laravel controller)
document.getElementById('notificationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    
    fetch('/doctors/notification-settings', {  // Your route
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Notification settings saved!');
            closeNotificationModal();
        }
    });
});


    //migration table store here for future use
    // Schema::table('doctors', function (Blueprint $table) {
    //     $table->boolean('notify_email')->default(false);
    //     $table->boolean('notify_whatsapp')->default(false);
    //     $table->boolean('notify_sms')->default(false);
    //     $table->boolean('daily_report')->default(false);
    //     $table->boolean('list_profile')->default(false);
    // });

// public function saveNotificationSettings(Request $request)
// {
//     $doctor = auth('doctors')->user();
//     $doctor->update($request->only([
//         'notify_email', 'notify_whatsapp', 'notify_sms', 
//         'daily_report', 'list_profile'
//     ]));
    
//     return response()->json(['success' => true]);
// }



// Notifications Popup Work Ends Here =========================>




// Patient Communication Popup Work Starts here ==============================>
    
    function openPatientCommModal() {
        document.getElementById("patientCommModal").style.display = "flex";
    }

    function closePatientCommModal() {
        document.getElementById("patientCommModal").style.display = "none";
    }

    // Form submission
    document.getElementById('patientCommForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('/doctors/patient-communication-settings', {
            method: 'POST',
            body: formData,
            headers: { 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Patient communication settings saved!');
                closePatientCommModal();
            }
        });
    });

    // Controller work here temp
    // public function savePatientCommSettings(Request $request)
    // {
    //     $doctor = auth('doctors')->user();
    //     $data = $request->only([
    //         'checkup_reminder', 'checkup_months', 'doctor_name_sms', 
    //         'clinic_name_sms', 'modify_approved_visits', 'past_dated_entries',
    //         'modify_rates', 'payment_sms', 'birthday_wishes',
    //         // NEW FIELDS
    //         'doctor_name_printouts', 'payments_casepaper', 'signature_prescription'
    //     ]);
        
    //     $doctor->update($data);
    //     return response()->json(['success' => true]);
    // }

    //migration table here 
    // Schema::table('doctors', function (Blueprint $table) {
    //     $table->boolean('checkup_reminder')->default(false);
    //     $table->integer('checkup_months')->default(3);
    //     $table->boolean('doctor_name_sms')->default(false);
    //     $table->boolean('clinic_name_sms')->default(false);
    //     $table->boolean('modify_approved_visits')->default(false);
    //     $table->boolean('past_dated_entries')->default(false);
    //     $table->boolean('modify_rates')->default(false);
    //     $table->boolean('payment_sms')->default(false);
    //     $table->boolean('birthday_wishes')->default(false);
    //     $table->boolean('doctor_name_printouts')->default(false);
    //     $table->boolean('payments_casepaper')->default(false);
    //     $table->boolean('signature_prescription')->default(false);
    // });



// Patient Communication Popup Work Ends here ==============================>


// Add New Medicines Popup Work Starts Here =================================>
    
    function openMedicinesModal() {
        document.getElementById("medicinesModal").style.display = "flex";
    }

    function closeMedicinesModal() {
        document.getElementById("medicinesModal").style.display = "none";
    }

    // Toggle pricing sections
    document.getElementById('priceAllClinics')?.addEventListener('change', function() {
        document.getElementById('allClinicsPricing').style.display = this.checked ? 'flex' : 'none';
    });

    // Form submission
    document.getElementById('medicineForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('/doctors/medicines', {
            method: 'POST',
            body: formData,
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Medicine added successfully!');
                closeMedicinesModal();
                // Reload medicines list if needed
            }
        });
    });


// Add New Medicines Popup Work Ends Here ===================================>



// All Complaints Modal work Start here ==================>

    function openComplaintsModal() {
        document.getElementById("ComplaintsModal").style.display = "flex";
    }

    function closeComplaintsModal() {
        document.getElementById("ComplaintsModal").style.display = "none";
    }

// All Complaints Modal work END here ====================>



// All Treatment Modal Work Starts here =====================>

    function openTreatmentModal() {
        document.getElementById("TreatmentsModal").style.display = "flex";
    }

    function closeTreatmentModal() {
        document.getElementById("TreatmentsModal").style.display = "none";
    }

    // Treatment Modal Toggle Logic
    document.addEventListener('DOMContentLoaded', function() {
        const allClinicsCheckbox = document.getElementById('allClinics');
        const allClinicsPricingDiv = document.getElementById('allClinicsTreatmentPricing');
        const perClinicPricing = document.getElementById('perClinicPricing');

        allClinicsPricingDiv.style.display = 'none';

        allClinicsCheckbox.addEventListener('change', function() {
            if (this.checked) {
                // Show All Clinics, Hide Per Clinic
                allClinicsPricingDiv.style.display = 'block';
                perClinicPricing.style.display = 'none';
            } else {
                // Hide All Clinics, Show Per Clinic
                allClinicsPricingDiv.style.display = 'none';
                perClinicPricing.style.display = 'block';
            }
        });
    });

// All Treatment Modal Work Starts here =====================>