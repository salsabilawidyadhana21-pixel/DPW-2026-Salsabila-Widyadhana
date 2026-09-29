<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENAMBAH ANGGOTA
// =====================================================

require_role(['admin', 'petugas']);


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

    header('Location: tambah.php');
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
// 3. MENGAMBIL DATA DARI FORM
// =====================================================

$nama = trim($_POST['nama'] ?? '');

$no_anggota = trim($_POST['no_anggota'] ?? '');

$alamat = trim($_POST['alamat'] ?? '');

$no_hp = trim($_POST['no_hp'] ?? '');


// =====================================================
// 4. VALIDASI DATA WAJIB
// =====================================================

if ($nama === '' || $no_anggota === '') {

    die(
        'Nama dan nomor anggota wajib diisi.'
    );
}


// =====================================================
// 5. VALIDASI PANJANG DATA
// =====================================================

if (strlen($nama) > 100) {

    die('Nama maksimal 100 karakter.');
}


if (strlen($no_anggota) > 30) {

    die('Nomor anggota maksimal 30 karakter.');
}


if (strlen($alamat) > 500) {

    die('Alamat maksimal 500 karakter.');
}


if (strlen($no_hp) > 20) {

    die('Nomor HP maksimal 20 karakter.');
}


// =====================================================
// 6. MENYIMPAN DATA
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "INSERT INTO anggota
        (
            nama,
            no_anggota,
            alamat,
            no_hp
        )
        VALUES
        (
            :nama,
            :no_anggota,
            :alamat,
            :no_hp
        )"
    );


    $stmt->execute([

        ':nama' => $nama,

        ':no_anggota' => $no_anggota,

        ':alamat' => $alamat !== ''
            ? $alamat
            : null,

        ':no_hp' => $no_hp !== ''
            ? $no_hp
            : null

    ]);


    // Setelah berhasil disimpan,
    // kembali ke daftar anggota
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jangan menampilkan detail database
    // kepada pengguna
    die(
        'Gagal menambahkan data anggota.'
    );

}

?>