document.addEventListener('DOMContentLoaded', function() {
    console.log('Clinic script loaded');
    
    //Tab handlers only
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function() {
            switchTab(this.getAttribute('data-tab'), this);
        });
    });

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
    
    // Load existing data
    if (timingSlots[slotKey]) {
        const data = timingSlots[slotKey];
        data.days.forEach(day => {
            const cb = document.querySelector(`input[value="${day}"]`);
            if (cb) cb.checked = true;
        });
        document.querySelector('input[name="from_time"]').value = data.from_time || '';
        document.querySelector('input[name="to_time"]').value = data.to_time || '';
    }
}

function saveSlot() {
    const days = Array.from(document.querySelectorAll('input[name="days[]"]:checked')).map(cb => cb.value);
    const fromTime = document.querySelector('input[name="from_time"]').value;
    const toTime = document.querySelector('input[name="to_time"]').value;

    if (!days.length || !fromTime || !toTime) {
        alert(' Please select days and valid time range');
        return;
    }

    const slotKey = `${currentSlot.day}-${currentSlot.slot}`;
    timingSlots[slotKey] = { days, from_time: fromTime, to_time: toTime };
    
    // Update visual display
    updateSlotDisplay(slotKey);
    updateSummary();
    
    // Store in form
    updateHiddenField();
    
    console.log(' Saved:', timingSlots[slotKey]);
    closeSlotModal();
}

function deleteSlot() {
    const slotKey = `${currentSlot.day}-${currentSlot.slot}`;
    if (timingSlots[slotKey]) {
        delete timingSlots[slotKey];
        updateSlotDisplay(slotKey);
        updateSummary();
        updateHiddenField();
        console.log('Deleted:', slotKey);
        closeSlotModal();
    }
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
