<?php

require_once '../includes/koneksi.php';
session_start();

// Pastikan data dikirim menggunakan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Mengambil data dari form
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = (int) ($_POST['tahun'] ?? 0);
$isbn = trim($_POST['isbn'] ?? '');
$stok = (int) ($_POST['stok'] ?? 0);
$kategori = trim($_POST['kategori'] ?? '');

// Validasi data
if ($judul === '' || $pengarang === '') {
    $_SESSION['error'] = 'Judul dan pengarang wajib diisi.';
    header('Location: tambah.php');
    exit;
}

if ($tahun < 1900 || $tahun > 2026) {
    $_SESSION['error'] = 'Tahun terbit tidak valid.';
    header('Location: tambah.php');
    exit;
}

if ($stok < 0) {
    $_SESSION['error'] = 'Stok tidak boleh negatif.';
    header('Location: tambah.php');
    exit;
}

try {

    // Menyimpan data menggunakan prepared statement
    $stmt = $pdo->prepare(
        "INSERT INTO buku
        (judul, pengarang, tahun, isbn, stok, kategori)
        VALUES
        (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)"
    );

    $stmt->execute([
        ':judul' => $judul,
        ':pengarang' => $pengarang,
        ':tahun' => $tahun,
        ':isbn' => $isbn !== '' ? $isbn : null,
        ':stok' => $stok,
        ':kategori' => $kategori !== '' ? $kategori : null
    ]);

    $_SESSION['success'] = 'Data buku berhasil ditambahkan.';

    header('Location: list.php');
    exit;

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data buku gagal ditambahkan.';

    header('Location: tambah.php');
    exit;
}