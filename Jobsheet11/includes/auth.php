<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.'];
    
    // Menggunakan $base jika ada, atau path relatif
    $redirect_url = isset($base) ? $base . 'auth/login.php' : '../auth/login.php';
    header('Location: ' . $redirect_url);
    exit;
}