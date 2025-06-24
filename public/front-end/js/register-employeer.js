// Improved Logo Upload Functionality
const logoUploadArea = document.getElementById('logoUploadArea');
const companyLogo = document.getElementById('companyLogo');
const uploadPrompt = document.getElementById('uploadPrompt');
const logoPreview = document.getElementById('logoPreview');

// Click handling for upload area
logoUploadArea.addEventListener('click', function() {
    companyLogo.click();
});

// File input change handler
companyLogo.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Check file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Maximum file size is 2MB');
            return;
        }

        // Check file type
        if (!file.type.match('image.*')) {
            alert('Only image files are allowed (JPG/PNG)');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
            logoPreview.src = event.target.result;
            logoPreview.style.display = 'block';
            uploadPrompt.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
});

// Form validation
document.getElementById('companyRegisterForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Password validation
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    if (password !== confirmPassword) {
        alert('Password and confirmation do not match!');
        return;
    }

    // Logo validation
    if (!companyLogo.files[0]) {
        alert('Please upload company logo');
        return;
    }

    // If validation passes, submit form
    alert('Company registration successful!');
    // window.location.href = 'company-dashboard.html'; // Redirect after successful registration
});
