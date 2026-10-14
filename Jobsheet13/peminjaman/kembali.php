<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'
    ];
    header('Location: ../auth/login.php');
    exit;
}
?>

<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

if ($id <= 0) {
    header('Location: riwayat.php');
    exit;
}

try {
    $pdo->beginTransaction();

    // Cari peminjaman yang sedang dipinjam
    $stmt = $pdo->prepare("SELECT * FROM peminjaman WHERE id = :id AND status = 'dipinjam' FOR UPDATE");
    $stmt->execute(['id' => $id]);
    $pinjam = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$pinjam) {
        $pdo->rollBack();
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data peminjaman tidak ditemukan atau buku sudah dikembalikan.'];
        header('Location: riwayat.php');
        exit;
    }

    // 1. Update status dan tanggal_kembali
    $stmtUpdate = $pdo->prepare("UPDATE peminjaman SET status = 'dikembalikan', tanggal_kembali = CURRENT_DATE WHERE id = :id");
    $stmtUpdate->execute(['id' => $id]);

    // 2. Tambah kembali stok buku (UPDATE buku SET stok = stok + 1)
    $stmtStok = $pdo->prepare("UPDATE buku SET stok = stok + 1 WHERE id = :buku_id");
    $stmtStok->execute(['buku_id' => $pinjam['buku_id']]);

    $pdo->commit();

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil dikembalikan! Stok buku telah bertambah.'];
} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses pengembalian: ' . $e->getMessage()];
}

header('Location: riwayat.php');
exit;