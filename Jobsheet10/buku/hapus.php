<?php

// Memastikan user sudah login
require_once '../includes/auth.php';


// =====================================================
// Hanya admin dan petugas yang boleh menghapus buku
// =====================================================

require_role(['admin', 'petugas']);


// Memanggil koneksi database
require_once '../includes/koneksi.php';


// =====================================================
// 1. Mengambil ID buku dari URL
// =====================================================

$id = $_GET['id'] ?? '';


// Jika ID tidak tersedia
if ($id === '') {

    header('Location: list.php');
    exit;
}


// =====================================================
// 2. Menghapus data berdasarkan ID
// =====================================================

try {

    $stmt = $pdo->prepare(
        "DELETE FROM buku
         WHERE id = :id"
    );


    $stmt->execute([
        ':id' => $id
    ]);


    // Setelah berhasil dihapus,
    // kembali ke daftar buku
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jika proses DELETE gagal
    die(
        'Gagal menghapus data buku: ' .
        $e->getMessage()
    );

}

?>