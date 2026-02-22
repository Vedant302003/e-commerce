/**
 * Admin Panel Custom Scripts
 */

document.addEventListener('DOMContentLoaded', function () {

    // Elements
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const toggleBtn = document.getElementById('sidebarToggle');

    // Create overlay for mobile
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    document.body.appendChild(overlay);

    // Bootstrap Tooltips Initialization
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover' // ensure tooltips only show on hover
        });
    });

    // Sidebar Toggle Logic
    if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
            if (window.innerWidth > 768) {
                // Desktop logic: collapse/expand
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');

                // When collapsed, hide tooltips if they are persistent, but wait
                // tooltips handle themselves mostly via bootstrap data attributes and hover.

                // Small animation delay to reposition elements
                setTimeout(() => {
                    window.dispatchEvent(new Event('resize'));
                }, 300);
            } else {
                // Mobile logic: open/close drawer
                sidebar.classList.toggle('mobile-open');
                if (sidebar.classList.contains('mobile-open')) {
                    overlay.classList.add('show');
                } else {
                    overlay.classList.remove('show');
                }
            }
        });
    }

    // Close sidebar on overlay click (mobile)
    overlay.addEventListener('click', function () {
        sidebar.classList.remove('mobile-open');
        this.classList.remove('show');
    });

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        }
    });

    // Submenu Accordion Logic
    const submenuToggles = document.querySelectorAll('.submenu-toggle');

    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', function (e) {
            e.preventDefault();

            // Expand sidebar if it's collapsed when a submenu toggle is clicked
            if (sidebar.classList.contains('collapsed')) {
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }

            const parentItem = this.closest('.nav-item');
            const isOpen = parentItem.classList.contains('open');

            // Accordion feature: Close all other open submenus
            document.querySelectorAll('.nav-item.open').forEach(item => {
                if (item !== parentItem) {
                    item.classList.remove('open');
                }
            });

            // Toggle current
            if (isOpen) {
                parentItem.classList.remove('open');
            } else {
                parentItem.classList.add('open');
            }
        });
    });

    // Auto-show change password modal if validation fails
    const changePasswordModalEl = document.getElementById('changePasswordModal');
    if (changePasswordModalEl && changePasswordModalEl.dataset.showModal === 'true') {
        const passwordModal = new bootstrap.Modal(changePasswordModalEl);
        passwordModal.show();
    }

    // Auto-show change name modal if validation fails
    const changeNameModalEl = document.getElementById('changeNameModal');
    if (changeNameModalEl && changeNameModalEl.dataset.showModal === 'true') {
        const nameModal = new bootstrap.Modal(changeNameModalEl);
        nameModal.show();
    }

});

// Global Image Preview Handlers for Product Management Forms
window.previewSingleImage = function (input) {
    const previewContainer = document.getElementById('single-image-preview-container');
    const previewImage = document.getElementById('single-image-preview');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('d-none');
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        previewContainer.classList.add('d-none');
        previewImage.src = '';
    }
}

window.previewMultipleImages = function (input) {
    const container = document.getElementById('multiple-images-preview-container');
    container.innerHTML = ''; // Clear previous previews

    if (input.files) {
        Array.from(input.files).forEach(file => {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail rounded shadow-sm border';
                    img.style.height = '100px';
                    img.style.width = '100px';
                    img.style.objectFit = 'cover';
                    container.appendChild(img);
                }
                reader.readAsDataURL(file);
            }
        });
    }
}
