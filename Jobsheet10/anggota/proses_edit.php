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
$id = $_POST['id'] ?? '';
$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

// Validasi ID
if (!is_numeric($id)) {
    header('Location: list.php');
    exit;
}

$id = (int) $id;

// Validasi data wajib
if ($nama === '' || $no_anggota === '') {
    header('Location: edit.php?id=' . $id);
    exit;
}

// Update data menggunakan prepared statement
$sql = "
    UPDATE anggota
    SET
        nama = :nama,
        no_anggota = :no_anggota,
        alamat = :alamat,
        no_hp = :no_hp
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nama' => $nama,
    ':no_anggota' => $no_anggota,
    ':alamat' => $alamat !== '' ? $alamat : null,
    ':no_hp' => $no_hp !== '' ? $no_hp : null,
    ':id' => $id
]);

// Kembali ke daftar anggota
header('Location: list.php');
exit;