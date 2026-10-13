<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.'
    ];
    
    // Redirect pasti menuju halaman login di dalam Jobsheet12
    header('Location: /Jobsheet12/auth/login.php');
    exit;
}