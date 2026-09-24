<?php

require_once '../includes/koneksi.php';
session_start();

// Hapus hanya boleh dilakukan dengan method POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

// Mengambil ID dari form
$id = $_POST['id'] ?? '';

// Validasi ID
if (!ctype_digit($id)) {
    $_SESSION['error'] = 'ID buku tidak valid.';
    header('Location: list.php');
    exit;
}

try {

    // Menghapus data menggunakan prepared statement
    $stmt = $pdo->prepare(
        "DELETE FROM buku
         WHERE id = :id"
    );

    $stmt->execute([
        ':id' => $id
    ]);

    $_SESSION['success'] = 'Data buku berhasil dihapus.';

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data buku gagal dihapus.';

}

header('Location: list.php');
exit;