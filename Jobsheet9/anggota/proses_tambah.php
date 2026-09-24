<?php

require_once '../includes/koneksi.php';
session_start();

// Pastikan data dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Mengambil data dari form
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

// Validasi data
if ($nama === '' || $noAnggota === '') {
    $_SESSION['error'] = 'Nama dan nomor anggota wajib diisi.';
    header('Location: tambah.php');
    exit;
}

try {

    // Menyimpan data menggunakan prepared statement
    $stmt = $pdo->prepare(
        "INSERT INTO anggota
        (nama, no_anggota, alamat, no_hp)
        VALUES
        (:nama, :no_anggota, :alamat, :no_hp)"
    );

    $stmt->execute([
        ':nama' => $nama,
        ':no_anggota' => $noAnggota,
        ':alamat' => $alamat !== '' ? $alamat : null,
        ':no_hp' => $noHp !== '' ? $noHp : null
    ]);

    $_SESSION['success'] = 'Data anggota berhasil ditambahkan.';

    header('Location: list.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data anggota gagal ditambahkan.';

    header('Location: tambah.php');
    exit;
}