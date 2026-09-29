<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// TUGAS MANDIRI:
// HANYA ADMIN YANG BOLEH MENGHAPUS ANGGOTA
// =====================================================

require_role('admin');


// =====================================================
// KONEKSI DATABASE
// =====================================================

require_once '../includes/koneksi.php';


// =====================================================
// CSRF PROTECTION
// =====================================================

require_once '../includes/csrf.php';


// =====================================================
// 1. MEMASTIKAN REQUEST MENGGUNAKAN POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: list.php');
    exit;
}


// =====================================================
// 2. VERIFIKASI TOKEN CSRF
// =====================================================

$csrf_token = $_POST['csrf_token'] ?? '';

if (!verify_csrf_token($csrf_token)) {

    die('Token CSRF tidak valid.');
}


// =====================================================
// 3. VALIDASI ID
// =====================================================

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);


if ($id === false || $id === null || $id <= 0) {

    header('Location: list.php');
    exit;
}


// =====================================================
// 4. HAPUS DATA ANGGOTA
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "DELETE FROM anggota
         WHERE id = :id"
    );


    $stmt->execute([
        ':id' => $id
    ]);


    // Setelah berhasil dihapus,
    // kembali ke daftar anggota
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jangan menampilkan detail database
    // kepada pengguna
    die(
        'Gagal menghapus data anggota.'
    );

}

?>