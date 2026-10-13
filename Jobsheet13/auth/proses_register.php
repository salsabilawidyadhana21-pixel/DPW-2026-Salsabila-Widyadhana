<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

verify_csrf_token($_POST['csrf_token'] ?? null);

$nama = trim(filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$username = trim(filter_var($_POST['username'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password = $_POST['password'] ?? '';

if ($nama === '' || $username === '' || $password === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Semua bidang wajib diisi.'];
    header('Location: register.php');
    exit;
}

$stmtCek = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
$stmtCek->execute(['username' => $username]);

if ($stmtCek->fetchColumn() > 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah terdaftar. Silakan pilih username lain.'];
    header('Location: register.php');
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
    $stmt->execute([
        'nama' => $nama,
        'username' => $username,
        'password' => $hashedPassword
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil! Silakan login.'];
    header('Location: login.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal mendaftar: ' . $e->getMessage()];
    header('Location: register.php');
    exit;
}