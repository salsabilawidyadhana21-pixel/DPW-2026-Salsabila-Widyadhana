<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Menghasilkan CSRF token jika belum ada
function csrf_token()
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Menghasilkan input hidden CSRF field untuk form
function csrf_field()
{
    $token = csrf_token();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
}

// Memverifikasi CSRF token dari POST request
function verify_csrf_token($token = null)
{
    $token = $token ?? ($_POST['csrf_token'] ?? '');
    
    if (empty($token) || empty($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Permintaan tidak valid (CSRF token mismatch).'
        ];
        
        $referer = $_SERVER['HTTP_REFERER'] ?? '../index.php';
        header('Location: ' . $referer);
        exit;
    }
}