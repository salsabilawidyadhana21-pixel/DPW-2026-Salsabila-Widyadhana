<?php

require_once '../includes/auth.php';

// Tugas Mandiri:
// Hanya admin yang memiliki akses hapus anggota.
require_role('admin');

require_once '../includes/koneksi.php';

// Pastikan ID tersedia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = (int) $_GET['id'];

// Hapus data anggota menggunakan prepared statement
$sql = "DELETE FROM anggota WHERE id = :id";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

// Kembali ke halaman daftar anggota
header('Location: list.php');
exit;