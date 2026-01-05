// Fix illness checkbox array saving issue
document.querySelector('form').addEventListener('submit', function() {
    const checkboxes = document.querySelectorAll('.illness-checkbox');
    let hasChecked = false;
    checkboxes.forEach(cb => {
        if (cb.checked) hasChecked = true;
    });
    if (!hasChecked) {
        // Add hidden input if no illness selected
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'illness[]';
        input.value = 'None';
        this.appendChild(input);
    }
});