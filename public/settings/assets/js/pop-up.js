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