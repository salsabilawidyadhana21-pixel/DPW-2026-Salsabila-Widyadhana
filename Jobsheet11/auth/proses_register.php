<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../includes/koneksi.php';

$nama     = trim(filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$username = trim(filter_var($_POST['username'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$password = $_POST['password'] ?? '';
$role     = trim($_POST['role'] ?? 'petugas');

if (!in_array($role, ['admin', 'petugas'], true)) {
    $role = 'petugas';
}

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($username === '') {
    $errors[] = "Username wajib diisi.";
}
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: register.php');
    exit;
}

$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
if ($stmt->fetchColumn() > 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Username sudah digunakan.'];
    header('Location: register.php');
    exit;
}

$hashPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)");
$stmt->execute([
    'nama'     => $nama,
    'username' => $username,
    'password' => $hashPassword,
    'role'     => $role
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Registrasi berhasil. Silakan login.'];
header('Location: login.php');
exit;
?>