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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id        = trim($_POST['id'] ?? '');
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = trim($_POST['tahun'] ?? '');
    $stok      = (int)($_POST['stok'] ?? 0);

    if ($id === '' || $judul === '' || $pengarang === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Semua kolom wajib diisi!'];
        header('Location: edit.php?id=' . $id);
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, stok = :stok WHERE id = :id");
        $stmt->execute([
            ':judul'     => $judul,
            ':pengarang' => $pengarang,
            ':tahun'     => $tahun,
            ':stok'      => $stok,
            ':id'         => $id
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui!'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui buku: ' . $e->getMessage()];
        header('Location: edit.php?id=' . $id);
        exit;
    }
} else {
    header('Location: list.php');
    exit;
}