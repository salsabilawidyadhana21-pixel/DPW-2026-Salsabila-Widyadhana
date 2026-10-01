<?php

// =====================================================
// MEMULAI SESSION
// =====================================================

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

if (!isset($_SESSION['user_id'])) {

    header('Location: ../auth/login.php');
    exit;
}


// =====================================================
// FUNGSI PEMBATASAN ROLE
// =====================================================

function require_role($roles)
{
    // Jika hanya satu role yang diberikan,
    // ubah menjadi array
    if (!is_array($roles)) {
        $roles = [$roles];
    }


    // Mengambil role dari session
    $current_role = $_SESSION['role'] ?? '';


    // Memastikan role user termasuk role
    // yang diperbolehkan
    if (!in_array($current_role, $roles, true)) {

        // Jika tidak memiliki akses,
        // arahkan kembali ke halaman utama
        header('Location: ../index.php');
        exit;
    }
}

?>