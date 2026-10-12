<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Membuat atau mengambil CSRF token dari session
 */
function generate_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Memverifikasi CSRF token dari request POST
 */
function verify_csrf_token(?string $token): void {
    if (empty($_SESSION['csrf_token']) || empty($token) || !hash_equals($_SESSION['csrf_token'], $token)) {
        http_response_code(403);
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Permintaan ditolak: CSRF Token tidak valid!'];
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? '../index.php'));
        exit;
    }
}
?>