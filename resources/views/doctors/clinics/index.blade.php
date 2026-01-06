<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('settings/assets/css/clinics-add-style.css') }}">
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <a href="{{ route('doctor.clinics.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <div class="tabs-header">
                <button class="tab-btn active" data-tab="address">Address</button>
                <button class="tab-btn" data-tab="timing">Timing</button>
                <button class="tab-btn" data-tab="setup">Setup</button>
                <button class="tab-btn" data-tab="picture">Picture</button>
                <button class="tab-btn" data-tab="services">Services</button>
            </div>

            <!-- Address Tab -->
            <div id="address" class="tab-content active">
                <form id="addressForm">
                    <div class="form-group">
                        <label class="form-label">Clinic Name</label>
                        <input type="text" class="form-control" name="clinic_name" value="" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Contact No 1</label>
                            <input type="tel" class="form-control" name="phone1" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Contact No 2</label>
                            <input type="tel" class="form-control" name="phone2" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" name="address_line1" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Landmark</label>
                            <input type="text" class="form-control" name="landmark" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" value="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pin Code</label>
                            <input type="text" class="form-control" name="pincode" value="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <select class="form-control" name="city">
                                <option value="">Select City</option>
                                <option value="Jalandhar" >Jalandhar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">State</label>
                            <select class="form-control" name="state">
                                <option value="">Select State</option>
                                <option value="Punjab" >Punjab</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>

            <!-- Timing Tab -->
            <div id="timing" class="tab-content">
                <form id="timingForm">
                    <div class="form-group mb-4">
                        <label class="form-label">Clinic</label>
                        <div style="padding: 12px 16px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border);">
                            <strong>KD Test</strong> 
                            
                        </div>
                        <span class="text-muted ms-2">Location: Jalandhar</span>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">
                            <input type="checkbox" id="defaultClinic" class="me-2" style="transform: scale(1.2);"> 
                            Mark as default
                        </label>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Doctor</label>
                        <div style="padding: 12px 16px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--primary-teal); border-left: 4px solid var(--primary-teal);">
                            <strong>Doctor Name</strong>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label class="form-label">Consultation Fees</label>
                        <input type="text" class="form-control" name="consultation_fees" value="" placeholder="₹500">
                    </div>

                    <h5 class="mb-3" style="color: var(--text-dark);">Timing Slots</h5>
                    <div class="timing-grid">
                        <div class="day-slot">
                            <div class="day-name">Mon</div>
                            <button class="slot-btn" onclick="openSlotModal('Mon', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Mon', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Tue</div>
                            <button class="slot-btn" onclick="openSlotModal('Tue', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Tue', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Wed</div>
                            <button class="slot-btn" onclick="openSlotModal('Wed', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Wed', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Thu</div>
                            <button class="slot-btn" onclick="openSlotModal('Thu', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Thu', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Fri</div>
                            <button class="slot-btn" onclick="openSlotModal('Fri', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Fri', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Sat</div>
                            <button class="slot-btn" onclick="openSlotModal('Sat', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Sat', 2)">Slot 2</button>
                        </div>
                        <div class="day-slot">
                            <div class="day-name">Sun</div>
                            <button class="slot-btn" onclick="openSlotModal('Sun', 1)">Slot 1</button>
                            <button class="slot-btn" onclick="openSlotModal('Sun', 2)">Slot 2</button>
                        </div>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>

            <!-- Setup Tab -->
            <div id="setup" class="tab-content">
                <form id="setupForm">
                    <!-- Primary Doctor Dropdown -->
                    <div class="form-group mb-4">
                        <label class="form-label">Primary Doctor 
                            <!-- <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem; opacity: 0.6;"></i> -->
                        </label>
                        <select class="form-control" name="primary_doctor">
                            <option selected>Sahil Kumar</option>
                            <option>Dr. John Doe</option>
                            <option>Dr. Jane Smith</option>
                        </select>
                    </div>

                    <!-- FAQ Accordion Sections -->
                    <div class="faq-sections">
                        <!-- Bill Preference -->
                        <div class="faq-section mb-4" style="background: #E0F7FA; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary-teal); margin-bottom: 10px;">
                            
                            <div class="faq-header d-flex justify-content-between align-items-center mb-3" onclick="toggleFaq('bill-preference')" style="cursor: pointer;">
                            
                                <h5 style="color: var(--primary-teal); margin: 0; font-weight: 600;">+ Bill Preference
                                </h5>
                                
                                <i class="fas fa-chevron-down" id="bill-icon" style="transition: transform 0.3s;"></i>
                            </div>
                            
                            <div id="bill-preference" class="faq-content" style="display: none;">
                                <div class="form-group mb-3">
                                    <label class="form-label">Tax Registration No:</label>
                                    <div class="d-flex align-items-center">
                                        <!-- <i class="fas fa-circle text-danger me-2"></i> -->
                                        <input type="text" class="form-control" placeholder="Tax Registration">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Bill No. Prefix</label>
                                        <input type="text" class="form-control" placeholder="(e.g. 2019-00)">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bill No. (e.g. 2019-00-001)</label>
                                        <input type="text" class="form-control" placeholder="2019-00-001">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">No. of Days for Remarks</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No. of Days for Invoice Due</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Bank Name</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bank Account no</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bank IFSC Code</label>
                                        <input type="text" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Printing -->
                        <div class="faq-section mb-4" style="background: #E0F7FA; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary-teal);">
                            <div class="faq-header d-flex justify-content-between align-items-center mb-3" onclick="toggleFaq('printing')" style="cursor: pointer;">
                                <h5 style="color: var(--primary-teal); margin: 0; font-weight: 600;">+ Printing</h5>
                                <i class="fas fa-chevron-down" id="printing-icon" style="transition: transform 0.3s;"></i>
                            </div>
                            <div id="printing" class="faq-content" style="display: none;">
                                <!-- Printing Header Selection -->
                                <div class="form-group mb-4">
                                    <label class="form-label mb-2" style="font-weight: 600;">Set Document Header:</label>
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="radio" name="printing_header" id="default_header" value="default" class="me-3" checked onchange="toggleHeaderFields('default')">
                                        <label for="default_header" class="form-label mb-0"> Default header:</label>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="radio" name="printing_header" id="clinic_logo" value="logo" class="me-3" onchange="toggleHeaderFields('logo')">
                                        <label for="clinic_logo" class="form-label mb-0"> Clinic Logo</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="radio" name="printing_header" id="clinic_letterhead" value="letterhead" class="me-3" onchange="toggleHeaderFields('letterhead')">
                                        <label for="clinic_letterhead" class="form-label mb-0"> Clinic Letterhead</label>
                                    </div>
                                </div>

                                <!-- Clinic Logo Fields (shown when Clinic Logo selected) -->
                                <div id="logo-fields" class="header-fields" style="display: none; background: #F0FDFC; padding: 16px; border-radius: 8px; border: 1px solid var(--primary-teal); margin-bottom: 16px;">
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; align-items: center;">
                                        <div style="border: 2px dashed #D1D5DB; border-radius: 8px; padding: 20px; text-align: center; height: 120px;">
                                            <i class="fas fa-image" style="font-size: 2rem; color: #9CA3AF;"></i>
                                            <p style="color: #6B7280; font-size: 0.9rem; margin-top: 8px;">Upload Logo</p>
                                        </div>
                                        <div style="border: 2px dashed #D1D5DB; border-radius: 8px; padding: 20px; text-align: center; height: 120px; position: relative;">
                                            <i class="fas fa-image" style="font-size: 2rem; color: #9CA3AF;"></i>
                                            <i class="fas fa-times position-absolute top-0 end-0 m-2 text-danger" style="font-size: 1rem;"></i>
                                            <p style="color: #6B7280; font-size: 0.9rem; margin-top: 8px;">Current Logo</p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="form-label">Preferred size 1.5" x 8"</label>
                                        <input type="file" class="form-control" accept="image/*">
                                    </div>
                                </div>

                                <!-- Clinic Letterhead Fields (shown when Clinic Letterhead selected) -->
                                <div id="letterhead-fields" class="header-fields" style="display: none; background: #F0FDFC; padding: 16px; border-radius: 8px; border: 1px solid var(--primary-teal); margin-bottom: 16px;">
                                    <div style="display: grid; grid-template-columns: 1fr; gap: 16px;">
                                        <div style="border: 2px dashed #EF4444; border-radius: 8px; padding: 40px; text-align: center; position: relative;">
                                            <i class="fas fa-file-image" style="font-size: 3rem; color: #EF4444;"></i>
                                            <i class="fas fa-times position-absolute top-0 end-0 m-2 text-danger" style="font-size: 1.2rem; background: white; border-radius: 50%; padding: 4px;"></i>
                                            <p style="color: #DC2626; font-size: 0.9rem; margin-top: 12px;">No letterhead uploaded</p>
                                        </div>
                                    </div>
                                    <input type="file" class="form-control mt-3" accept="image/*">
                                </div>

                                <!-- Use Printed Stationary Section (always visible) -->
                                <div class="form-group">
                                    <label class="form-label mb-2" style="font-weight: 600;">Use printed stationary:</label>
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="checkbox" id="leave_top" class="me-3" style="width: 18px; height: 18px;">
                                        <label for="leave_top" class="form-label mb-0">Leave</label>
                                        <input type="text" class="form-control" style="width: 80px; display: inline-block; margin: 0 8px;" placeholder="2">
                                        <label class="form-label mb-0">inches from top</label>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" id="leave_left" class="me-3" style="width: 18px; height: 18px;">
                                        <label for="leave_left" class="form-label mb-0">Leave</label>
                                        <input type="text" class="form-control" style="width: 80px; display: inline-block; margin: 0 8px;" placeholder="2">
                                        <label class="form-label mb-0">inches from left</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Patient -->
                        <div class="faq-section mb-4" style="background: #E0F7FA; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary-teal);">
                            <div class="faq-header d-flex justify-content-between align-items-center mb-3" onclick="toggleFaq('patient')" style="cursor: pointer;">
                                <h5 style="color: var(--primary-teal); margin: 0; font-weight: 600;">+ Patient</h5>
                                <i class="fas fa-chevron-down" id="patient-icon" style="transition: transform 0.3s;"></i>
                            </div>
                            <div id="patient" class="faq-content" style="display: none;">
                                <div class="form-row">
                                    <div class="form-group">
                                        <input type="checkbox" class="form-control" style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Include Visiting Doctor name if selected in SMS</label>
                                        
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" class="form-control" style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Include Patient name in Visiting Doctor</label>
                                    </div>

                                    <div class="form-group">
                                        <input type="checkbox" class="form-control" style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Auto generate Patient</label>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Prefix</label>
                                    <input type="text" class="form-control" value="C">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Next Seq. No.</label>
                                    <input type="number" class="form-control" value="1">
                                </div>
                            </div>
                        </div>

                        <!-- Consent -->
                        <div class="faq-section mb-4" style="background: #E0F7FA; padding: 20px; border-radius: 12px; border-left: 4px solid var(--primary-teal);">
                            <div class="faq-header d-flex justify-content-between align-items-center mb-3" onclick="toggleFaq('consent')" style="cursor: pointer;">
                                <h5 style="color: var(--primary-teal); margin: 0; font-weight: 600;">+ Consent</h5>
                                <i class="fas fa-chevron-down" id="consent-icon" style="transition: transform 0.3s;"></i>
                            </div>
                            <div id="consent" class="faq-content" style="display: none;">
                                <div class="form-group mb-3">
                                    <input type="checkbox" name="consent_add_after_patient" class="me-2">
                                    <label class="form-label">Show consent dialog after patient added</label>
                                </div>
                                <h4>Consent Forms</h4> <br>
                                <div class="form-group mb-3">
                                    <input type="radio" name="consent_default" class="me-2">
                                    <label class="form-label">Clinic Default</label>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="radio" name="consent_default" class="me-2">
                                    <label class="form-label">COVID-19 Consent</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="save-btn mt-4" onclick="saveSetupData()">Save</button>
                </form>

                
            </div>


            <!-- Picture Tab -->
            <div id="picture" class="tab-content">
                <form id="pictureForm">
                    <h5 class="mb-4" style="color: var(--text-dark);">Clinic Picture</h5>
                    <div class="form-group">
                        <label class="form-label">Upload Clinic Image</label>
                        <input type="file" class="form-control" accept="image/*">
                    </div>
                    <div style="border: 2px dashed var(--border); border-radius: 12px; padding: 40px; text-align: center; margin-top: 20px;">
                        <i class="fas fa-image" style="font-size: 3rem; color: var(--text-muted);"></i>
                        <p class="mt-2" style="color: var(--text-muted);">No image uploaded</p>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>

            <!-- Services Tab -->
            <div id="services" class="tab-content">
                <form id="pictureForm">
                    <h5 class="mb-4" style="color: var(--text-dark);">Services Offered</h5>
                    <div class="form-group">
                        <label class="form-label">Add Service</label>
                        <input type="text" class="form-control" placeholder="General Consultation">
                    </div>
                    <div style="background: var(--bg-light); border-radius: 12px; padding: 20px; margin-top: 16px;">
                        <p style="color: var(--text-muted);">No services added yet</p>
                    </div>
                    <button type="submit" class="save-btn">Save</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Slot Modal Popup -->
    <div id="slotModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <h3 class="modal-title" id="modalTitle">Add Slot</h3>
                <button class="close-modal" onclick="closeSlotModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="slotForm">
                <div class="day-selector">
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Mon"> Mon
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Tue"> Tue
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Wed"> Wed
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Thu"> Thu
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Fri"> Fri
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Sat"> Sat
                    </label>
                    <label class="day-checkbox">
                        <input type="checkbox" name="days[]" value="Sun"> Sun
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">From Time</label>
                    <input type="time" class="form-control" name="from_time" required>
                </div>
                <div class="form-group">
                    <label class="form-label">To Time</label>
                    <input type="time" class="form-control" name="to_time" required>
                </div>

                <button type="button" class="save-btn" onclick="saveSlot()">Add Slot</button>
            </form>
        </div>
    </div>

      <script src="{{ asset('settings/assets/js/clinicAddScript.js') }}"></script>
</body>
</html>
