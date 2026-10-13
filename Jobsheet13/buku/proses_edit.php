<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

verify_csrf_token($_POST['csrf_token'] ?? null);

$id = (int) ($_POST['id'] ?? 0);
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = (int) ($_POST['tahun'] ?? 0);
$isbn = trim($_POST['isbn'] ?? '');
$stok = (int) ($_POST['stok'] ?? 0);

if ($id <= 0 || $judul === '' || $pengarang === '' || $tahun <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data tidak valid.'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok WHERE id = :id");
    $stmt->execute([
        'id' => $id,
        'judul' => $judul,
        'pengarang' => $pengarang,
        'tahun' => $tahun,
        'isbn' => $isbn,
        'stok' => $stok
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui!'];
    header('Location: list.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui buku: ' . $e->getMessage()];
    header('Location: list.php');
    exit;
}