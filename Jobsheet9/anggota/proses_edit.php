<?php

require_once '../includes/koneksi.php';
session_start();

// Pastikan data dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Mengambil data dari form
$id = $_POST['id'] ?? '';
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

// Validasi ID
if (!ctype_digit($id)) {
    $_SESSION['error'] = 'ID anggota tidak valid.';
    header('Location: list.php');
    exit;
}

// Validasi data
if ($nama === '' || $noAnggota === '') {
    $_SESSION['error'] = 'Nama dan nomor anggota wajib diisi.';
    header('Location: edit.php?id=' . $id);
    exit;
}

try {

    // Mengubah data anggota menggunakan prepared statement
    $stmt = $pdo->prepare(
        "UPDATE anggota
         SET nama = :nama,
             no_anggota = :no_anggota,
             alamat = :alamat,
             no_hp = :no_hp
         WHERE id = :id"
    );

    $stmt->execute([
        ':nama' => $nama,
        ':no_anggota' => $noAnggota,
        ':alamat' => $alamat !== '' ? $alamat : null,
        ':no_hp' => $noHp !== '' ? $noHp : null,
        ':id' => $id
    ]);

    $_SESSION['success'] = 'Data anggota berhasil diperbarui.';

    header('Location: list.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data anggota gagal diperbarui.';

    header('Location: edit.php?id=' . $id);
    exit;
}