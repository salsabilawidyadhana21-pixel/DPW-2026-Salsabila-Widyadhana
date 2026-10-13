<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.'
    ];
    
    // Redirect relatif yang aman sesuai letak folder Jobsheet
    header('Location: ' . dirname($_SERVER['SCRIPT_NAME']) . '/../auth/login.php');
    exit;
}