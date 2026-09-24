<?php

require_once '../includes/auth.php';
require_role(['admin', 'petugas']);

require_once '../includes/koneksi.php';

// Pastikan data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Ambil data dari form
$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

// Validasi data wajib
if ($nama === '' || $no_anggota === '') {
    header('Location: tambah.php');
    exit;
}

// Simpan data menggunakan prepared statement
$sql = "
    INSERT INTO anggota
    (nama, no_anggota, alamat, no_hp)
    VALUES
    (:nama, :no_anggota, :alamat, :no_hp)
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nama' => $nama,
    ':no_anggota' => $no_anggota,
    ':alamat' => $alamat !== '' ? $alamat : null,
    ':no_hp' => $no_hp !== '' ? $no_hp : null
]);

// Kembali ke daftar anggota
header('Location: list.php');
exit;