<?php

// =====================================================
// 1. Memulai session
// =====================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// =====================================================
// 2. Mengecek apakah user sudah login
// =====================================================

if (!isset($_SESSION['user_id'])) {

    // Jika belum login, arahkan ke halaman login
    header('Location: ../auth/login.php');
    exit;
}


// =====================================================
// 3. Fungsi untuk mengecek role user
// =====================================================

function require_role($roles)
{
    // Jika hanya satu role yang diberikan,
    // ubah menjadi array agar mudah diperiksa
    if (!is_array($roles)) {
        $roles = [$roles];
    }


    // Mengambil role user dari session
    $current_role = $_SESSION['role'] ?? '';


    // Mengecek apakah role user diperbolehkan
    if (!in_array($current_role, $roles, true)) {

        // Jika role tidak memiliki akses,
        // kembali ke halaman utama
        header('Location: ../index.php');
        exit;
    }
}

?>