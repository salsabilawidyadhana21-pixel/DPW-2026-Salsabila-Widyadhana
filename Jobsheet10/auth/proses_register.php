<?php

// PROSES REGISTER

require_once '../includes/koneksi.php';

session_start();


// =====================================================
// 1. Memastikan form dikirim menggunakan POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php');
    exit;
}


// =====================================================
// 2. Mengambil data dari form register
// =====================================================

$nama = trim($_POST['nama'] ?? '');
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';


// =====================================================
// 3. Validasi data
// =====================================================

if ($nama === '' || $username === '' || $password === '') {

    $_SESSION['error'] = 'Semua data wajib diisi.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 4. Mengecek apakah username sudah digunakan
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

    $_SESSION['error'] = 'Username sudah digunakan.';

    header('Location: register.php');
    exit;
}


// =====================================================
// 5. Mengamankan password
// Password tidak disimpan dalam bentuk asli
// =====================================================

$passwordHash = password_hash(
    $password,
    PASSWORD_DEFAULT
);


// =====================================================
// 6. Menyimpan data user ke database
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
        ':password' => $passwordHash,
        ':role' => 'petugas'
    ]);


    // Menyimpan pesan berhasil
    $_SESSION['success'] =
        'Registrasi berhasil. Silakan login.';


    // Kembali ke halaman login
    header('Location: login.php');
    exit;


} catch (PDOException $e) {

    // Jika proses INSERT gagal
    $_SESSION['error'] =
        'Registrasi gagal. Silakan coba lagi.';

    header('Location: register.php');
    exit;
}

?>