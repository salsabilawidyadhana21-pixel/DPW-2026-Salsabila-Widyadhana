<?php

// PROSES REGISTER

require_once '../includes/koneksi.php';

session_start();


// =====================================================
// 1. Memastikan proses register menggunakan POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: register.php');
    exit;
}


// =====================================================
// 2. Mengambil data dari form
// =====================================================

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';
$password_confirm = $_POST['password_confirm'] ?? '';


// =====================================================
// 3. Validasi input wajib
// =====================================================

if (
    $nama === '' ||
    $username === '' ||
    $password === '' ||
    $password_confirm === ''
) {

    $_SESSION['error'] =
        'Semua data wajib diisi.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 4. Validasi panjang input
// =====================================================

if (strlen($nama) > 255) {

    $_SESSION['error'] =
        'Nama maksimal 255 karakter.';

    header('Location: register.php');
    exit;
}


if (strlen($username) > 100) {

    $_SESSION['error'] =
        'Username maksimal 100 karakter.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 5. Memastikan password dan konfirmasi sama
// =====================================================

if ($password !== $password_confirm) {

    $_SESSION['error'] =
        'Password dan konfirmasi password tidak sama.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 6. Validasi panjang password
// Minimal 8 karakter
// =====================================================

if (strlen($password) < 8) {

    $_SESSION['error'] =
        'Password minimal 8 karakter.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 7. Mengecek apakah username sudah digunakan
// Menggunakan prepared statement
// =====================================================

$stmt = $pdo->prepare(
    "SELECT id
     FROM users
     WHERE username = :username"
);

$stmt->execute([
    ':username' => $username
]);


// Jika username sudah ada
if ($stmt->fetch()) {

    $_SESSION['error'] =
        'Username sudah digunakan.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 8. Membuat password hash
// Password tidak disimpan dalam bentuk plaintext
// =====================================================

$password_hash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// =====================================================
// 9. Role menggunakan whitelist
// User yang melakukan register tidak boleh
// menentukan role admin sendiri.
//
// Semua akun hasil register diberikan role petugas.
// =====================================================

$role = 'petugas';


// =====================================================
// 10. Menyimpan user ke database
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "INSERT INTO users
        (nama, username, password, role)
        VALUES
        (:nama, :username, :password, :role)"
    );


    $stmt->execute([
        ':nama' => $nama,
        ':username' => $username,
        ':password' => $password_hash,
        ':role' => $role
    ]);


    // Register berhasil
    $_SESSION['success'] =
        'Registrasi berhasil. Silakan login.';

    header('Location: login.php');
    exit;


} catch (PDOException $e) {

    // Jangan menampilkan detail error database
    // kepada pengguna
    $_SESSION['error'] =
        'Registrasi gagal. Silakan coba lagi.';

    header('Location: register.php');
    exit;
}

?>