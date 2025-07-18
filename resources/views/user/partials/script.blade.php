<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Test Bootstrap Loading -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Bootstrap check:', typeof bootstrap);
    if (typeof bootstrap !== 'undefined') {
        console.log('Bootstrap Modal:', bootstrap.Modal);
    }
});
</script>

<!-- Custom JS -->
<script>
// Enhanced dropdown toggle function
function toggleDropdown(event) {
    event.preventDefault();
    event.stopPropagation();
    
    // Find the dropdown menu related to the clicked element
    const clickedItem = event.target.closest('.nav-item');
    const dropdownMenu = clickedItem ? clickedItem.querySelector('.dropdown-menu') : null;
    
    if (dropdownMenu) {
        if (dropdownMenu.classList.contains('show')) {
            dropdownMenu.classList.remove('show');
        } else {
            // Close any other open dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                menu.classList.remove('show');
            });
            dropdownMenu.classList.add('show');
        }
    }
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('.dropdown')) {
        document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});

// Logout function for applicants
function logout() {
    event.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form').submit();
    }
}

// Logout function for companies
function logoutCompany() {
    event.preventDefault();
    if (confirm('Are you sure you want to logout?')) {
        document.getElementById('logout-form-company').submit();
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom dropdown system initialized');
});
</script>
