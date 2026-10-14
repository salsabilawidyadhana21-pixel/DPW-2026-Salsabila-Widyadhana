<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu.'];
    header('Location: ../auth/login.php');
    exit;
}

require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $tanggal_kembali = date('Y-m-d');
        // Update menggunakan nama kolom tanggal_kembali
        $stmt = $pdo->prepare("UPDATE peminjaman SET status = 'Dikembalikan', tanggal_kembali = :tanggal_kembali WHERE id = :id");
        $stmt->execute([
            ':tanggal_kembali' => $tanggal_kembali,
            ':id'              => $id
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil dikembalikan!'];
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses pengembalian: ' . $e->getMessage()];
    }
}

header('Location: riwayat.php');
exit;