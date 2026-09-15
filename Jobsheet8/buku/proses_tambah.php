<?php

require_once '../includes/koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];

if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}

if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}

if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    session_start();

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: tambah.php');
    exit;
}

$sql = "INSERT INTO buku
        (judul, pengarang, tahun, isbn, stok, kategori)
        VALUES
        (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':judul' => $judul,
    ':pengarang' => $pengarang,
    ':tahun' => (int) $tahun,
    ':isbn' => $isbn,
    ':stok' => (int) $stok,
    ':kategori' => $kategori
]);

session_start();

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Buku berhasil ditambahkan ke database.'
];

header('Location: list.php');
exit;