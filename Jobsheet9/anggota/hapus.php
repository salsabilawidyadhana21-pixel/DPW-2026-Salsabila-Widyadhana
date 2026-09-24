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
    $_SESSION['error'] = 'ID anggota tidak valid.';
    header('Location: list.php');
    exit;
}

try {

    // Menghapus data menggunakan prepared statement
    $stmt = $pdo->prepare(
        "DELETE FROM anggota
         WHERE id = :id"
    );

    $stmt->execute([
        ':id' => $id
    ]);

    $_SESSION['success'] = 'Data anggota berhasil dihapus.';

} catch (PDOException $e) {

    $_SESSION['error'] = 'Data anggota gagal dihapus.';

}

header('Location: list.php');
exit;