<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

verify_csrf_token($_POST['csrf_token'] ?? null);

$nama     = trim(filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$username = trim(filter_var($_POST['username'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password = $_POST['password'] ?? '';

$errors = [];
if ($nama === '') $errors[] = "Nama wajib diisi.";
if ($username === '') $errors[] = "Username wajib diisi.";
if (strlen($password) < 6) $errors[] = "Password minimal 6 karakter.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

$cek = $pdo->prepare("SELECT id FROM users WHERE username = :username");
$cek->execute(['username' => $username]);
if ($cek->fetch()) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah digunakan.'];
    header('Location: register.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, 'petugas')");
$stmt->execute([
    'nama'     => $nama,
    'username' => $username,
    'password' => password_hash($password, PASSWORD_DEFAULT)
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil, silakan login.'];
header('Location: login.php');
exit;
?>