document.getElementById('photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.querySelector('.photo-upload img');
            if (preview) preview.src = e.target.result;
            else {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'photo-preview';
                document.querySelector('.photo-upload').appendChild(img);
            }
        }
        reader.readAsDataURL(file);
    }
});

function togglePassword(btn) {
    const input = btn.previousElementSibling;
    const icon = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}