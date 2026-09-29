<?php

// =====================================================
// CSRF PROTECTION
// =====================================================


// Memastikan session sudah dimulai
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// =====================================================
// Membuat token CSRF
// =====================================================

function csrf_token()
{
    // Jika token belum tersedia,
    // buat token baru secara acak
    if (empty($_SESSION['csrf_token'])) {

        $_SESSION['csrf_token'] =
            bin2hex(random_bytes(32));
    }

    // Mengembalikan token
    return $_SESSION['csrf_token'];
}


// =====================================================
// Memeriksa token CSRF
// =====================================================

function verify_csrf_token($token)
{
    // Memastikan token session dan token
    // dari form tersedia
    if (
        empty($_SESSION['csrf_token']) ||
        empty($token)
    ) {
        return false;
    }


    // Membandingkan token secara aman
    return hash_equals(
        $_SESSION['csrf_token'],
        $token
    );
}

?>