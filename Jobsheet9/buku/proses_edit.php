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
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = (int) ($_POST['tahun'] ?? 0);
$isbn = trim($_POST['isbn'] ?? '');
$stok = (int) ($_POST['stok'] ?? 0);
$kategori = trim($_POST['kategori'] ?? '');

// Validasi ID
if (!ctype_digit($id)) {
    $_SESSION['error'] = 'ID buku tidak valid.';
    header('Location: list.php');
    exit;
}

// Validasi data
if ($judul === '' || $pengarang === '') {
    $_SESSION['error'] = 'Judul dan pengarang wajib diisi.';
    header('Location: edit.php?id=' . $id);
    exit;
}

if ($tahun < 1900 || $tahun > 2026) {
    $_SESSION['error'] = 'Tahun terbit tidak valid.';
    header('Location: edit.php?id=' . $id);
    exit;
}

if ($stok < 0) {
    $_SESSION['error'] = 'Stok tidak boleh negatif.';
    header('Location: edit.php?id=' . $id);
    exit;
}

try {

    // Mengubah data buku menggunakan prepared statement
    $stmt = $pdo->prepare(
        "UPDATE buku
         SET judul = :judul,
             pengarang = :pengarang,
             tahun = :tahun,
             isbn = :isbn,
             stok = :stok,
             kategori = :kategori
         WHERE id = :id"
    );

    $stmt->execute([
        ':judul' => $judul,
        ':pengarang' => $pengarang,
        ':tahun' => $tahun,
        ':isbn' => $isbn !== '' ? $isbn : null,
        ':stok' => $stok,
        ':kategori' => $kategori !== '' ? $kategori : null,
        ':id' => $id
    ]);

    $_SESSION['success'] = 'Data buku berhasil diperbarui.';

    header('Location: list.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data buku gagal diperbarui.';

    header('Location: edit.php?id=' . $id);
    exit;
}