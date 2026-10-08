<?php
session_start();
// menyesuaikan dengan file koneksi database
require_once '../config/koneksi.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status_baru = $_GET['status'] === 'Nonaktif' ? 'Nonaktif' : 'Aktif';

    try {
        // menggunakan PDO
        $stmt = $pdo->prepare("UPDATE buku SET status = :status WHERE id = :id");
        $stmt->execute([
            ':status' => $status_baru,
            ':id' => $id
        ]);
        
        header("Location: list.php?pesan=status_berhasil");
        exit;
    } catch (PDOException $e) {
        echo "Gagal mengubah status: " . $e->getMessage();
    }
} else {
    header("Location: list.php");
    exit;
}
?>