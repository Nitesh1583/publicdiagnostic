// Modal script (same as before - already working perfectly)
        const patientModal = document.getElementById('patientModal');
        patientModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const patient = JSON.parse(button.getAttribute('data-patient'));
            
            document.getElementById('modalPatientName').textContent = patient.patient_name;

            const illnessBadges = Array.isArray(patient.illness) && patient.illness.length
                ? patient.illness.map(ill => `<span class="badge bg-warning me-1 mb-1">${ill}</span>`).join('')
                : 'None';

            const allergies = patient.allergies || {};
            const habits = patient.habits || {};
            const attachments = Array.isArray(patient.attachments) ? patient.attachments : [];

            const detailsHtml = `
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="detail-row">
                            <span class="detail-label">Patient ID:</span> <strong>${patient.patient_id}</strong>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Contact:</span> ${patient.contact_number || 'N/A'}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Email:</span> ${patient.email || 'N/A'}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Gender:</span> <span class="badge bg-primary">${patient.gender}</span>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">DOB:</span> ${new Date(patient.dob).toLocaleDateString('en-IN')}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-row">
                            <span class="detail-label">Clinic:</span> ${patient.clinic_name || 'N/A'}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Emergency Contact:</span> ${patient.emergency_contact || 'N/A'}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Blood Group:</span> ${patient.blood_group || 'N/A'}
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Address:</span> ${patient.address || 'N/A'}
                        </div>
                    </div>
                </div>
                <hr class="my-4">
                <h6><i class="fas fa-notes-medical text-primary me-2"></i>Medical Details</h6>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="detail-row">
                            <span class="detail-label">Illness:</span> <div class="mt-1">${illnessBadges}</div>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Allergies:</span>
                            <div class="mt-1 small">
                                Food: ${allergies.food || 'None'}<br>
                                Drugs: ${allergies.drugs || 'None'}<br>
                                Others: ${allergies.others || 'None'}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-row">
                            <span class="detail-label">Habits:</span>
                            <div class="mt-1 small">
                                Smoking: ${habits.smoking || 'N/A'}<br>
                                Drinking: ${habits.drinking || 'N/A'}<br>
                                Tobacco: ${habits.tobacco || 'N/A'}
                            </div>
                        </div>
                        <div class="detail-row">
                            <span class="detail-label">Medical History:</span> <div class="mt-1">${patient.medical_history || 'None'}</div>
                        </div>
                    </div>
                </div>
                ${attachments.length ? `
                <hr class="my-4">
                <h6><i class="fas fa-paperclip text-info me-2"></i>Attachments (${attachments.length})</h6>
                <div class="row">
                    ${attachments.map(path => `
                        <div class="col-md-3 mb-2">
                            <a href="/storage/${path}" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-file me-1"></i>${path.split('/').pop().slice(0,20)}...
                            </a>
                        </div>
                    `).join('')}
                </div>` : ''}
            `;

            document.getElementById('patientDetails').innerHTML = detailsHtml;
        });