<?php

// Memastikan user sudah login
require_once '../includes/auth.php';


// =====================================================
// Hanya admin dan petugas yang boleh menambahkan buku
// =====================================================

require_role(['admin', 'petugas']);


// Memanggil koneksi database
require_once '../includes/koneksi.php';


// =====================================================
// 1. Memastikan form dikirim menggunakan POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: tambah.php');
    exit;
}


// =====================================================
// 2. Mengambil data dari form
// =====================================================

$judul = trim($_POST['judul'] ?? '');

$pengarang = trim($_POST['pengarang'] ?? '');

$tahun = $_POST['tahun'] ?? '';

$isbn = trim($_POST['isbn'] ?? '');

$stok = $_POST['stok'] ?? 0;

$kategori = trim($_POST['kategori'] ?? '');


// =====================================================
// 3. Validasi data wajib
// =====================================================

if (
    $judul === '' ||
    $pengarang === '' ||
    $tahun === ''
) {

    die(
        'Judul, pengarang, dan tahun wajib diisi.'
    );
}


// =====================================================
// 4. Menyimpan data ke database
// Menggunakan prepared statement
// =====================================================

try {

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


    // Setelah berhasil disimpan,
    // kembali ke daftar buku
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jika proses INSERT gagal
    die(
        'Gagal menambahkan data buku: ' .
        $e->getMessage()
    );

}

?>