<?php

// PROSES LOGIN

require_once '../includes/koneksi.php';

session_start();


// =====================================================
// 1. Memastikan proses login menggunakan POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: login.php');
    exit;
}


// =====================================================
// 2. Mengambil data dari form login
// =====================================================

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';


// =====================================================
// 3. Validasi input
// =====================================================

if ($username === '' || $password === '') {

    $_SESSION['error'] =
        'Username dan password wajib diisi.';

    header('Location: login.php');
    exit;
}


// =====================================================
// 4. Mencari user berdasarkan username
// Menggunakan prepared statement
// =====================================================

$stmt = $pdo->prepare(
    "SELECT *
     FROM users
     WHERE username = :username"
);

$stmt->execute([
    ':username' => $username
]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);


// =====================================================
// 5. Mengecek password
// password_verify() digunakan untuk mencocokkan
// password yang dimasukkan dengan password hash
// yang tersimpan di database
// =====================================================

if (
    !$user ||
    !password_verify($password, $user['password'])
) {

    $_SESSION['error'] =
        'Username atau password salah.';

    header('Location: login.php');
    exit;
}


// =====================================================
// 6. Jika login berhasil, simpan data user
// ke dalam session
// =====================================================

$_SESSION['user_id'] = $user['id'];
$_SESSION['nama'] = $user['nama'];
$_SESSION['username'] = $user['username'];
$_SESSION['role'] = $user['role'];


// =====================================================
// 7. Login berhasil
// Arahkan user ke halaman utama
// =====================================================

header('Location: ../index.php');
exit;

?>