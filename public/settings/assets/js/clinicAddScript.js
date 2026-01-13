document.addEventListener('DOMContentLoaded', function() {
    console.log('Clinic script loaded');
    
    //Tab handlers only
        document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', function (e) {

            if (this.classList.contains('disabled')) {
                e.preventDefault();
                alert('Please save previous step first.');
                return;
            }

            switchTab(this.dataset.tab, this);
            
        });
    });

    // 👇 AUTO OPEN TAB AFTER REDIRECT
    // const activeTab = "{{ $activeTab ?? 'address' }}";
    // const btn = document.querySelector(`.tab-btn[data-tab="${activeTab}"]`);
    // if (btn && !btn.classList.contains('disabled')) {
    //     btn.click();
    // }

    //  Modal handlers (timing slots)
    const modalOverlay = document.getElementById('slotModal');
    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) closeSlotModal();
    });
    
    document.querySelector('.modal').addEventListener('click', function(e) {
        e.stopPropagation();
    });
    document.querySelector('.close-modal').addEventListener('click', closeSlotModal);
});

// Slot data storage
let currentSlot = { day: '', slot: 1 };
let timingSlots = {};
const doctorName = 'Sahil Kumar';

function openSlotModal(day, slot) {
    currentSlot = { day, slot };
    
    // Update modal title
    document.getElementById('modalTitle').textContent = `${doctorName} for Slot ${slot}`;
    
    // Load slot data into modal
    const slotKey = `${day}-${slot}`;
    loadSlotData(slotKey);
    
    // Show modal
    const modal = document.getElementById('slotModal');
    modal.style.display = 'flex';
    modal.classList.add('show');
    
    setTimeout(() => document.querySelector('input[name="from_time"]').focus(), 150);
}

function loadSlotData(slotKey) {
    // Clear form
    document.querySelectorAll('input[name="days[]"]').forEach(cb => cb.checked = false);
    document.querySelector('input[name="from_time"]').value = '';
    document.querySelector('input[name="to_time"]').value = '';
    
    // NEW: Check ALL days for this slot number (show existing time)
    const allDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    let existingTime = null;
    
    allDays.forEach(day => {
        const daySlotKey = `${day}-${currentSlot.slot}`;
        if (timingSlots[daySlotKey]) {
            // Mark this day as checked
            const cb = document.querySelector(`input[value="${day}"]`);
            if (cb) cb.checked = true;
            
            // Use first found time
            if (!existingTime) {
                existingTime = {
                    from_time: timingSlots[daySlotKey].from_time,
                    to_time: timingSlots[daySlotKey].to_time
                };
            }
        }
    });
    
    // Load time if found
    if (existingTime) {
        document.querySelector('input[name="from_time"]').value = existingTime.from_time;
        document.querySelector('input[name="to_time"]').value = existingTime.to_time;
    }
}


function saveSlot() {
    const days = Array.from(document.querySelectorAll('input[name="days[]"]:checked')).map(cb => cb.value);
    const fromTime = document.querySelector('input[name="from_time"]').value;
    const toTime = document.querySelector('input[name="to_time"]').value;

    if (!days.length || !fromTime || !toTime) {
        alert('Please select days and valid time range');
        return;
    }

    // Apply SAME time to ALL selected days for THIS SLOT NUMBER
    days.forEach(day => {
        const slotKey = `${day}-${currentSlot.slot}`;
        timingSlots[slotKey] = { 
            days: [day],  // Single day per slot
            from_time: fromTime, 
            to_time: toTime 
        };
        updateSlotDisplay(slotKey);  // Update each day display
    });
    
    updateSummary();
    updateHiddenField();    
    
    console.log(` Applied ${fromTime}-${toTime} to ${days.length} days (Slot ${currentSlot.slot})`);
    closeSlotModal();
}


function deleteSlot() {
    const allDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    
    // Delete ALL days for this SLOT NUMBER
    allDays.forEach(day => {
        const slotKey = `${day}-${currentSlot.slot}`;
        if (timingSlots[slotKey]) {
            delete timingSlots[slotKey];
            updateSlotDisplay(slotKey);
        }
    });
    
    updateSummary();
    updateHiddenField();
    console.log(`🗑️ Cleared Slot ${currentSlot.slot} from all days`);
    closeSlotModal();
}


function updateSlotDisplay(slotKey) {
    const timeElement = document.querySelector(`[data-slot-key="${slotKey}"]`);
    if (!timeElement) return;
    
    if (timingSlots[slotKey]) {
        const data = timingSlots[slotKey];
        const daysText = data.days.slice(0, 3).join(', ') + (data.days.length > 3 ? '...' : '');
        const timeText = `${data.from_time} - ${data.to_time}`;
        timeElement.innerHTML = `<div class="days-list">${daysText}</div><div>${timeText}</div>`;
        timeElement.classList.remove('empty');
    } else {
        timeElement.innerHTML = 'Not Set';
        timeElement.classList.add('empty');
    }
}

function updateSummary() {
    const activeSlots = Object.keys(timingSlots);
    const badge = document.getElementById('activeSlotBadge');
    const text = document.getElementById('activeSlotText');
    
    if (activeSlots.length > 0) {
        badge.style.display = 'inline-flex';
        text.textContent = `${activeSlots.length} slot${activeSlots.length > 1 ? 's' : ''} configured`;
    } else {
        badge.style.display = 'none';
    }
}

function updateHiddenField() {
    const hiddenField = document.createElement('input');
    hiddenField.type = 'hidden';
    hiddenField.name = 'timing_slots';
    hiddenField.value = JSON.stringify(timingSlots);
    
    // Clear previous
    const existing = document.querySelector('#timingForm input[name="timing_slots"]');
    if (existing) existing.remove();
    
    document.getElementById('timingForm').appendChild(hiddenField);
}


function closeSlotModal() {
    const modal = document.getElementById('slotModal');
    modal.classList.remove('show');
    setTimeout(() => modal.style.display = 'none', 300);
}

function switchTab(tabName, button) {
    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.getElementById(tabName).classList.add('active');
    button.classList.add('active');
}

// FAQ Toggle
function toggleFaq(sectionId) {
    const content = document.getElementById(sectionId);
    const icon = document.getElementById(`${sectionId}-icon`);
    const section = content.parentElement;
    
    if (content.style.display === 'block') {
        content.style.display = 'none';
        if (icon) icon.style.transform = 'rotate(0deg)';
    } else {
        document.querySelectorAll('.faq-content').forEach(c => {
            c.style.display = 'none';
            const i = document.getElementById(`${c.id}-icon`);
            if (i) i.style.transform = 'rotate(0deg)';
        });
        content.style.display = 'block';
        if (icon) icon.style.transform = 'rotate(180deg)';
    }
}

function toggleHeaderFields(type) {
    document.querySelectorAll('.header-fields').forEach(field => field.style.display = 'none');
    if (type === 'logo') {
        document.getElementById('logo-fields').style.display = 'block';
    } else if (type === 'letterhead') {
        document.getElementById('letterhead-fields').style.display = 'block';
    }
}

//Success message pop up after every tab dats was saved
document.addEventListener('DOMContentLoaded', function () {
    if (window.__SUCCESS_MESSAGE__) {
        showToast(window.__SUCCESS_MESSAGE__);
    }
});

function showToast(message) {
    const toast = document.getElementById('successToast');
    document.getElementById('toastMessage').textContent = message;

    toast.classList.add('show');

    // Auto hide after 4 seconds
    setTimeout(() => {
        hideToast();
    }, 4000);
}

function hideToast() {
    const toast = document.getElementById('successToast');
    toast.classList.remove('show');
}

// function enableEdit(tabId) {
//     // Enable all inputs in selected tab
//     document
//         .querySelectorAll(
//             `#${tabId} input, #${tabId} select, #${tabId} textarea`
//         )
//         .forEach(el => el.removeAttribute('disabled'));

//     // Set edit flag
//     const flag = document.getElementById(`${tabId}_edit_flag`);
//     if (flag) {
//         flag.value = 1;
//     }

//     console.log(`Edit enabled for: ${tabId}`);
// }
