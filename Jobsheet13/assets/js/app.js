// =====================================================
// 1. KONFIRMASI LOGOUT
// =====================================================
const logoutLinks = document.querySelectorAll('a[href*="logout.php"]');

logoutLinks.forEach(function (link) {
    link.addEventListener('click', function (event) {
        const yakin = confirm('Apakah Anda yakin ingin keluar dari sistem?');
        if (!yakin) {
            event.preventDefault();
        }
    });
});

// =====================================================
// 2. TOGGLE HAMBURGER MENU RESPONSIVE
// =====================================================
document.addEventListener('DOMContentLoaded', function () {
    const toggleBtn = document.getElementById('nav-toggle-btn');
    const nav = document.querySelector('header nav');

    if (toggleBtn && nav) {
        toggleBtn.addEventListener('click', function () {
            nav.classList.toggle('active');
            nav.classList.toggle('nav-open');
        });
    }
});