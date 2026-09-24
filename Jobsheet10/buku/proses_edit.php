<?php

// Memastikan user sudah login
require_once '../includes/auth.php';


// =====================================================
// Hanya admin dan petugas yang boleh mengubah buku
// =====================================================

require_role(['admin', 'petugas']);


// Memanggil koneksi database
require_once '../includes/koneksi.php';


// =====================================================
// 1. Memastikan form dikirim menggunakan POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: list.php');
    exit;
}


// =====================================================
// 2. Mengambil data dari form
// =====================================================

$id = $_POST['id'] ?? '';

$judul = trim($_POST['judul'] ?? '');

$pengarang = trim($_POST['pengarang'] ?? '');

$tahun = $_POST['tahun'] ?? '';

$isbn = trim($_POST['isbn'] ?? '');

$stok = $_POST['stok'] ?? 0;

$kategori = trim($_POST['kategori'] ?? '');


// =====================================================
// 3. Validasi data
// =====================================================

if (
    $id === '' ||
    $judul === '' ||
    $pengarang === '' ||
    $tahun === ''
) {

    die(
        'ID, judul, pengarang, dan tahun wajib diisi.'
    );
}


// =====================================================
// 4. Mengubah data buku
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "UPDATE buku
         SET
            judul = :judul,
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


    // Setelah berhasil diubah,
    // kembali ke daftar buku
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jika proses UPDATE gagal
    die(
        'Gagal mengubah data buku: ' .
        $e->getMessage()
    );

}

?>