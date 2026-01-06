// let currentClinicId = {{ $clinic->id ?? 'null' }};

// Tabs Function JS ==================>
function switchTab(tabName, button) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.classList.remove('active');
    });
    
    // Remove active class from all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName).classList.add('active');
    
    // Add active class to clicked button
    if (button) {
        button.classList.add('active');
    }
}

// Attach event listeners to tab buttons
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.tab-btn').forEach(button => {
        button.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');
            switchTab(tabName, this);
        });
    });
});

// Add Slot Timing TAB JS Here ===============>
function openSlotModal(day, slot) {
    document.getElementById('modalTitle').textContent = `${day} - Slot ${slot}`;
    document.getElementById('slotModal').classList.add('show');
}

function closeSlotModal() {
    document.getElementById('slotModal').classList.remove('show');
}

function saveSlot() {
    console.log('Slot saved');
    closeSlotModal();
}

function saveClinicData() {
    console.log('Clinic data saved');
    // Add your save logic here
}

function deleteClinic(id) {
    if (confirm('Are you sure you want to delete this clinic?')) {
        console.log('Deleting clinic:', id);
        // Add your delete logic here
    }
}

// Setup Tabs JS Here ====================>
let openFaq = null;
function toggleFaq(sectionId) {
    const content = document.getElementById(sectionId);
    const icon = document.getElementById(sectionId + '-icon');
    const section = content.parentElement;
    
    if (content.style.display === 'block') {
        // Close
        content.style.display = 'none';
        icon.style.transform = 'rotate(0deg)';
        section.classList.remove('active');
    } else {
        // Close others
        document.querySelectorAll('.faq-content').forEach(c => {
            c.style.display = 'none';
            const relatedIcon = document.getElementById(c.id + '-icon');
            if (relatedIcon) relatedIcon.style.transform = 'rotate(0deg)';
            c.parentElement.classList.remove('active');
        });
        
        // Open selected
        content.style.display = 'block';
        icon.style.transform = 'rotate(180deg)';
        section.classList.add('active');
    }
}

function saveSetupData() {
    console.log('Setup preferences saved');
    // Add your save logic here
}


// Setups Tabs ->> Printing FAQ JS 
function toggleHeaderFields(type) {
    // Hide all conditional fields
    document.querySelectorAll('.header-fields').forEach(field => {
    field.style.display = 'none';
    });

    // Show specific fields based on selection
    if (type === 'logo') {
    document.getElementById('logo-fields').style.display = 'block';
    } else if (type === 'letterhead') {
    document.getElementById('letterhead-fields').style.display = 'block';
    }
    // Default shows nothing extra
}

