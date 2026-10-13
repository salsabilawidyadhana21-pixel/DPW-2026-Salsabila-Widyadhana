<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id > 0) {
    try {
        $stmt = $pdo->prepare("DELETE FROM anggota WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil dihapus.'];
    } catch (Exception $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menghapus anggota: ' . $e->getMessage()];
    }
}

header('Location: list.php');
exit;