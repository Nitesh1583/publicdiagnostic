<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('settings/assets/css/clinics-add-style.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>
<body>
@php
$steps = [
    'address'  => 0,
    'timing'   => 1,
    'setup'    => 2,
    'picture'  => 3,
    'services' => 4,
];

$currentStep = $steps[$clinicStep ?? 'address'];

$requestedTab  = request('tab', 'address');
$requestedStep = $steps[$requestedTab] ?? 0;

// ACTIVE TAB LOGIC
$activeTab = ($requestedStep <= $currentStep)
    ? $requestedTab
    : array_search($currentStep, $steps);

function isReadOnlyTab($tab, $steps, $currentStep) {
    return $steps[$tab] < $currentStep;
}
@endphp

    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <a href="{{ route('doctors.dashboard') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to dashboard
                </a>
            </div>
        </div>

        <!-- Tabs -->
        <div class="tabs-container">
            <div class="tabs-header">
                @foreach($steps as $tab => $step)
                    <button
                        class="tab-btn
                            {{ $step <= $currentStep ? '' : 'disabled' }}
                            {{ $activeTab === $tab ? 'active' : '' }}"
                        data-tab="{{ $tab }}"
                        {{ $step > $currentStep ? 'disabled' : '' }}
                    >
                        {{ ucfirst($tab) }}

                        <!-- @if($step < $currentStep)
                            <i class="fas fa-pen ms-1"></i>
                        @endif -->
                    </button>
                @endforeach
                </div>

            <!-- <p>Current Step: {{ $currentStep }}</p>
            <p>Active Tab: {{ $activeTab }}</p> -->

            <!-- Address Tab -->
            @php $addressReadonly = isReadOnlyTab('address', $steps, $currentStep); @endphp

            <div id="address" class="tab-content {{ $activeTab === 'address' ? 'active' : '' }}">
                <form id="addressForm" action="{{ route('clinics.address.save') }}" method="POST">
                    @csrf
                    <input type="hidden" id="address_edit_flag" name="address_edit_flag" value="0">
                    <div class="form-group">
                        <label class="form-label">Clinic Name</label>
                        <input type="text" class="form-control" name="clinic_name" 
                            value="{{ old('clinic_name', $clinic->clinic_name ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }} required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Contact No 1</label>
                            <input type="tel" class="form-control" name="phone1" 
                                value="{{ old('phone1', $clinic->phone1 ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Contact No 2</label>
                            <input type="tel" class="form-control" name="phone2" value="{{ old('phone1', $clinic->phone2 ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Address Line 1</label>
                            <input type="text" class="form-control" name="address_line1" 
                                value="{{ old('address_line1', $clinic->address_line1 ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Landmark</label>
                            <input type="text" class="form-control" name="landmark" 
                                value="{{ old('landmark', $clinic->landmark ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }} >
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <input type="text" class="form-control" name="location" 
                                value="{{ old('location', $clinic->location ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }} required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Pin Code</label>
                            <input type="text" class="form-control" name="pincode" 
                                value="{{ old('pincode', $clinic->pincode ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }}>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">City</label>
                            <input type="text" class="form-control" name="city" 
                            value="{{ old('city', $clinic->city ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }}>
                        </div>
                        <div class="form-group">
                            <label class="form-label">State</label>
                            <input type="text" class="form-control" name="state" 
                                value="{{ old('state', $clinic->state ?? '') }}" {{ $addressReadonly ? 'readonly disabled' : '' }}>
                        </div>
                    </div>

                    @if(!$addressReadonly)
                        <button type="submit" class="save-btn">Save</button>
                    @endif
                    
                    @if($clinic && session('clinic_step') !== 'address')
                        <!-- <div class="mb-3 text-end">
                            <button type="button" class="edit-btn" onclick="enableEdit('address')">
                                Edit </button>
                        </div> -->
                    @endif
                </form>
            </div>

            <!-- Timing Tab -->
            @php $timingReadonly = isReadOnlyTab('timing', $steps, $currentStep); @endphp
<div id="timing" class="tab-content {{ $activeTab === 'timing' ? 'active' : '' }}">
    <form id="timingForm" action="{{ route('clinics.timing.save') }}" method="POST">
        @csrf
        <!-- Clinic Info -->
        <input type="hidden" id="timing_edit_flag" name="timing_edit_flag" value="0">
        <div class="form-group mb-4">
            <label class="form-label">Clinic</label>
            <div style="padding: 12px 16px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--border);">
                <strong>{{ $clinic->clinic_name ?? 'New Clinic' }}</strong>
            </div>
            <span class="text-muted ms-2">
                     Location: {{ $clinic->city ?? 'Not set yet' }}
            </span>
        </div>

        <!-- Default Checkbox -->
        <div class="form-group mb-4">
            <label class="form-label">
                <input type="checkbox" id="defaultClinic" name="is_default" class="me-2" style="transform: scale(1.2);"> 
                Mark as default
            </label>
        </div>

        <!-- Doctor Info -->
        <div class="form-group mb-4">
            <label class="form-label">Doctor</label>
            <div style="padding: 12px 16px; background: var(--bg-light); border-radius: 12px; border: 1px solid var(--primary-teal); border-left: 4px solid var(--primary-teal);">
                <strong>{{  Auth::guard('doctors')->user()->doctor_name  }}</strong>
            </div>
        </div>

        <!-- Consultation Fees -->
        <div class="form-group mb-4">
            <label class="form-label">Consultation Fees</label>
            <input type="text" class="form-control" name="consultation_fees" value="" placeholder="₹500" {{ $timingReadonly ? 'readonly disabled' : '' }}>
        </div>

        <!-- Timing Slots Title -->
        <h5 class="mb-3" style="color: var(--text-dark);">Timing Slots</h5>

        <!-- Timing Slots Title + Summary -->
        <div class="slot-summary mb-3" id="slotSummary">
            <div class="summary-badge" id="activeSlotBadge" style="display: none;">
                <i class="fas fa-check-circle me-1"></i>
                <span id="activeSlotText"></span>
            </div>
        </div>

        
        <!-- IMPROVED TIMING GRID - Matches Image 1 exactly -->
        <div class="timing-grid">
            <div class="day-slot" data-day="Mon">
                <div class="day-name">Mon</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Mon', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Mon-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Mon', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Mon-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Tue">
                <div class="day-name">Tue</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Tue', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Tue-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Tue', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Tue-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Wed">
                <div class="day-name">Wed</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Wed', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Wed-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Wed', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Wed-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Thu">
                <div class="day-name">Thu</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Thu', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Thu-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Thu', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Thu-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Fri">
                <div class="day-name">Fri</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Fri', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Fri-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Fri', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Fri-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Sat">
                <div class="day-name">Sat</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Sat', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Sat-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Sat', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Sat-2"></div>
                </button>
            </div>

            <div class="day-slot" data-day="Sun">
                <div class="day-name">Sun</div>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Sun', 1)" data-slot="1" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 1</span>
                        <div class="slot-time" data-slot-key="Sun-1"></div>
                    </button>
                    <button type="button" class="slot-btn" onclick="openSlotModal('Sun', 2)" data-slot="2" {{ $timingReadonly ? 'readonly disabled' : '' }}>>
                        <span class="slot-label">Slot 2</span>
                        <div class="slot-time" data-slot-key="Sun-2"></div>
                </button>
            </div>
        </div>
            @if(!$timingReadonly)
                <button type="submit" class="save-btn">Save</button>
            @endif


        @if($clinic && session('clinic_step') !== 'timing')
            <!-- <div class="mb-3 text-end">
                 <button type="button" class="edit-btn" onclick="enableEdit('timing')">
                    Edit </button>
            </div> -->
        @endif
    </form>
</div>

<!-- NEW SLOT MODAL - EXACTLY LIKE IMAGES 2 & 3 -->
<div id="slotModal" class="modal-overlay">
    <div class="modal">
        <!-- Modal Header - Matches Image 2 -->
        <div class="modal-header">
            <div class="modal-title-container">
                <h3 class="modal-title" id="modalTitle">Slot 1</h3>
                <span class="modal-subtitle">Select days</span>
            </div>
            <button class="close-modal">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Body - Matches Image 3 exactly -->
        <form id="slotForm">
            <!-- Days Selection - 2 rows exactly like image -->
            <div class="day-selector">
                <div class="day-row">
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
                </div>
                <div class="day-row">
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
            </div>

            <!-- Time Selection -->
            <div class="form-group">
                <label class="form-label">From time</label>
                <input type="time" class="form-control" name="from_time" required>
            </div>
            <div class="form-group">
                <label class="form-label">To time</label>
                <input type="time" class="form-control" name="to_time" required>
            </div>

            <!-- Action Buttons - Exactly like image 3 -->
            <div class="modal-actions">
                <button type="button" class="btn-delete" onclick="deleteSlot()">
                    <i class="fas fa-trash me-1"></i>Delete
                </button>
                <button type="button" class="save-btn" onclick="saveSlot()">
                    <i class="fas fa-plus me-1"></i>Add
                </button>
            </div>
        </form>
    </div>
</div>


            <!-- Setup Tab -->
            @php $setupReadonly = isReadOnlyTab('setup', $steps, $currentStep); @endphp
            <div id="setup" class="tab-content {{ $activeTab === 'setup' ? 'active' : '' }}">
                <form id="setupForm" action="{{ route('clinics.setup.save') }}" method="POST">
                    @csrf
                    <input type="hidden" id="setup_edit_flag" name="setup_edit_flag" value="0">
                    <!-- Primary Doctor Dropdown -->
                    <div class="form-group mb-4">
                        <label class="form-label">Primary Doctor 
                            <!-- <i class="fas fa-chevron-down ms-1" style="font-size: 0.8rem; opacity: 0.6;"></i> -->
                        </label>
                        <select class="form-control" name="primary_doctor">
                            <option value="{{  Auth::guard('doctors')->user()->doctor_name  }}" selected>{{  Auth::guard('doctors')->user()->doctor_name  }}</option>
                            
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
                                        <input type="text" class="form-control" placeholder="Tax Registration" name="tax_registration_no" value="" {{ $setupReadonly ? 'readonly disabled' : '' }} >
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Bill No. Prefix</label>
                                        <input type="text" class="form-control" placeholder="(e.g. 2019-00)" name="bill_no_prefix" value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bill No. (e.g. 2019-00-001)</label>
                                        <input type="text" class="form-control" placeholder="2019-00-001" name="bill_no" value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">No. of Days for Remarks</label>
                                        <input type="text" class="form-control" name="number_days_remarks" value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">No. of Days for Invoice Due</label>
                                        <input type="text" class="form-control" name="number_days_invioce_due" value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group">
                                        <label class="form-label">Bank Name</label>
                                        <input type="text" class="form-control" name="bank_name" 
                                        value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bank Account no</label>
                                        <input type="text" class="form-control" name="bank_account_no" value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Bank IFSC Code</label>
                                        <input type="text" class="form-control" name="bank_ifsc" 
                                        value="" {{ $setupReadonly ? 'readonly disabled' : '' }}>
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
                                        <input type="radio" name="printing_header" id="default_header" value="default" class="me-3" checked onchange="toggleHeaderFields('default')" >
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
                                    <div class="form-group d-flex ">
                                        <input type="checkbox" class="form-control" name="visiting_dct_name_sms" style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Include Visiting Doctor name if selected in SMS</label>
                                        
                                    </div>
                                    <div class="form-group d-flex ">
                                        <input type="checkbox" class="form-control" name="patient_name_visiting_doctor"style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Include Patient name in Visiting Doctor</label>
                                    </div>

                                    <div class="form-group d-flex ">
                                        <input type="checkbox" class="form-control" name="auto_gen_patient" style="height: auto; width: auto; margin-top: 0;">
                                        <label class="form-label">Auto generate Patient</label>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Prefix</label>
                                    <input type="text" class="form-control" name="auto_gen_patient_prefix" value="">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Next Seq. No.</label>
                                    <input type="text" class="form-control" name="auto_gen_patient_seq_no" value="">
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
                                    <input type="radio" name="consent_clinic_default" class="me-2">
                                    <label class="form-label">Clinic Default</label>
                                </div>
                                <div class="form-group mb-3">
                                    <input type="radio" name="consent_covid_19" class="me-2">
                                    <label class="form-label">COVID-19 Consent</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$setupReadonly)
                        <button type="submit" class="save-btn mt-4">Save</button>
                    @endif

                </form>        
            </div>


            <!-- Picture Tab -->
            @php $pictureReadonly = isReadOnlyTab('picture', $steps, $currentStep); @endphp
            <div id="picture" class="tab-content {{ $activeTab === 'picture' ? 'active' : '' }}">
                <form id="pictureForm" action="{{ route('clinics.picture.save') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <input type="hidden" id="picture_edit_flag" name="picture_edit_flag" value="0">
                    <h5 class="mb-4" style="color: var(--text-dark);">Clinic Picture</h5>
                    <div class="form-group">
                        <label class="form-label">Upload Clinic Image</label>
                        <input type="file" class="form-control" name="upload_picture" accept="image/*" {{ $pictureReadonly ? 'disabled' : '' }}>>
                    </div>
                    <div style="border: 2px dashed var(--border); border-radius: 12px; padding: 40px; text-align: center; margin-top: 20px;">
                        <i class="fas fa-image" style="font-size: 3rem; color: var(--text-muted);"></i>
                        <p class="mt-2" style="color: var(--text-muted);">No image uploaded</p>
                    </div>

                    @if(!$pictureReadonly)
                        <button type="submit" class="save-btn">Save</button>
                    @endif

                </form>
            </div>

            <!-- Services Tab -->
            @php $servicesReadonly = isReadOnlyTab('services', $steps, $currentStep); @endphp
            <div id="services" class="tab-content {{ $activeTab === 'services' ? 'active' : '' }}">
                <form id="servicesForm" action="{{ route('clinics.services.save') }}" method="POST" >
                    @csrf
                    <input type="hidden" id="services_edit_flag" name="services_edit_flag" value="0">
                    <h5 class="mb-4" style="color: var(--text-dark);">Services Offered</h5>
                    <div class="form-group">
                        <label class="form-label">Add Service</label>
                        <input type="text" class="form-control" name="add_services" value ="" placeholder="General Consultation"  {{ $servicesReadonly ? 'readonly disabled' : '' }}>
                    </div>
                    <div style="background: var(--bg-light); border-radius: 12px; padding: 20px; margin-top: 16px;">
                        <p style="color: var(--text-muted);">No services added yet</p>
                    </div>
                    
                    @if(!$servicesReadonly)
                        <button type="submit" class="save-btn">Save</button>
                    @endif

                </form>
            </div>
        </div>

    </div>

    {{-- Success Popup --}}
    <div id="successToast" class="success-toast">
        <div class="toast-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="toast-content">
            <h4>Success</h4>
            <p id="toastMessage"></p>
        </div>
        <button class="toast-close" onclick="hideToast()">
            <i class="fas fa-times"></i>
        </button>
    </div>

    @if(session('success'))
    <script>
        window.__SUCCESS_MESSAGE__ = @json(session('success'));
    </script>
    @endif

    <script src="{{ asset('settings/assets/js/clinicAddScript.js') }}"></script>

</body>
</html>