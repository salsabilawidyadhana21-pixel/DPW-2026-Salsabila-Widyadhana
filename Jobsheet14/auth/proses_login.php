<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

$token = $_POST['csrf_token'] ?? '';
if (empty($token) || !isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Token CSRF tidak valid.'];
    header('Location: login.php');
    exit;
}

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username dan Password wajib diisi.'];
    header('Location: login.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['nama'] = $user['nama'] ?? $user['username'];
    $_SESSION['role'] = $user['role'] ?? 'petugas';

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Selamat datang kembali, ' . $user['nama'] . '!'];
    header('Location: ../index.php');
    exit;
} else {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username atau Password salah.'];
    header('Location: login.php');
    exit;
}