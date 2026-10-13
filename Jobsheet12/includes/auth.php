<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error', 
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.'
    ];
    
    header('Location: /index.php');
    exit;
}