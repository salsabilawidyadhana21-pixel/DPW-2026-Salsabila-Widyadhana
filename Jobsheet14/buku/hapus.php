<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi Auth
if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu.'];
    header('Location: ../auth/login.php');
    exit;
}

require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM buku WHERE id = :id");
        $stmt->execute([':id' => $id]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil dihapus!'];
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus buku: ' . $e->getMessage()];
    }
}

header('Location: list.php');
exit;