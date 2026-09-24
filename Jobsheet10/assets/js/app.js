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