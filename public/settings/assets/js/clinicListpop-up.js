function openClinicListPopup() {
    document.getElementById("clinicListPopup").style.display = "flex";
}

function closeClinicListPopup() {
    document.getElementById("clinicListPopup").style.display = "none";
}

function filterClinics() {
    const search = document.getElementById('clinicSearch').value.toLowerCase();
    const cards = document.querySelectorAll('.clinic-card');
    let visibleCount = 0;
    
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(search)) {
            card.style.display = '';
            visibleCount++;
        } else {
            card.style.display = 'none';
        }
    });
    
    document.getElementById('noClinicsMsg').style.display = visibleCount === 0 ? 'block' : 'none';
}

// Action functions (AJAX)
function toggleDefault(id, isDefault) {
    fetch(`/clinics/${id}/default`, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
    }).then(() => location.reload());
}

function deleteClinic(id) {
    if (confirm('Delete clinic?')) {
        fetch(`/clinics/${id}`, { method: 'DELETE', 
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') }
        }).then(() => location.reload());
    }
}
