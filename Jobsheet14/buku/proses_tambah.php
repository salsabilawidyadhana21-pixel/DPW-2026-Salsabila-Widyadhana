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
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = trim($_POST['tahun'] ?? '');
    $stok      = (int)($_POST['stok'] ?? 0);

    if ($judul === '' || $pengarang === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Judul dan Pengarang wajib diisi!'];
        header('Location: tambah.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, tahun, stok, status) VALUES (:judul, :pengarang, :tahun, :stok, 'Aktif')");
        $stmt->execute([
            ':judul'     => $judul,
            ':pengarang' => $pengarang,
            ':tahun'     => $tahun,
            ':stok'      => $stok
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan!'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menambah buku: ' . $e->getMessage()];
        header('Location: tambah.php');
        exit;
    }
} else {
    header('Location: list.php');
    exit;
}