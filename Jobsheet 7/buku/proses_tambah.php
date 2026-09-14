<?php

session_start();

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = $_POST['tahun'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];

/*
 * VALIDASI SERVER-SIDE
 */

if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}

if (
    !is_numeric($tahun) ||
    $tahun < 1900 ||
    $tahun > 2026
) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}

if (
    !is_numeric($stok) ||
    $stok < 0
) {
    $errors[] = "Stok tidak boleh negatif.";
}


/*
 * JIKA ADA ERROR
 */

if (!empty($errors)) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: tambah.php');
    exit;
}


/*
 * MEMBUAT ARRAY SESSION JIKA BELUM ADA
 */

if (!isset($_SESSION['buku'])) {
    $_SESSION['buku'] = [];
}


/*
 * MENYIMPAN DATA KE SESSION
 */

$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int) $tahun,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori
];


/*
 * PESAN BERHASIL
 */

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Buku berhasil ditambahkan.'
];


/*
 * KEMBALI KE DAFTAR BUKU
 */

header('Location: list.php');
exit;