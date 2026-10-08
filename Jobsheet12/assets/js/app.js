// =====================================================
// 1. KONFIRMASI LOGOUT
// =====================================================

// Mencari semua tombol/link yang mengarah ke logout
const logoutLinks = document.querySelectorAll(
    'a[href*="logout.php"]'
);


// Memberikan konfirmasi sebelum logout
logoutLinks.forEach(function (link) {

    link.addEventListener('click', function (event) {

        const yakin = confirm(
            'Apakah Anda yakin ingin logout?'
        );


        // Jika user memilih Cancel,
        // proses logout dibatalkan
        if (!yakin) {
            event.preventDefault();
        }

    });

});


// =====================================================
// 2. HAMBURGER MENU
// =====================================================

// Mencari tombol hamburger
const navToggle = document.getElementById('nav-toggle');

// Mencari menu navigasi
const mainNav = document.getElementById('main-nav');


// Memastikan kedua elemen ditemukan
if (navToggle && mainNav) {

    // Menjalankan fungsi ketika hamburger diklik
    navToggle.addEventListener('click', function () {

        // Menampilkan / menyembunyikan menu
        mainNav.classList.toggle('nav-open');

    });

}