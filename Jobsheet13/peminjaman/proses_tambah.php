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
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

verify_csrf_token($_POST['csrf_token'] ?? null);

$anggota_id = (int) ($_POST['anggota_id'] ?? 0);
$buku_id = (int) ($_POST['buku_id'] ?? 0);

if ($anggota_id <= 0 || $buku_id <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota dan Buku wajib dipilih.'];
    header('Location: tambah.php');
    exit;
}

try {
    // TUGAS MANDIRI: Validasi bisnis anggota dengan peminjaman terlambat (> 14 hari)
    $sqlCekTerlambat = "SELECT COUNT(*) FROM peminjaman 
                        WHERE anggota_id = :anggota_id 
                        AND status = 'dipinjam' 
                        AND CURRENT_DATE > tanggal_jatuh_tempo";
    $stmtCek = $pdo->prepare($sqlCekTerlambat);
    $stmtCek->execute(['anggota_id' => $anggota_id]);
    
    if ($stmtCek->fetchColumn() > 0) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Peminjaman Ditolak! Anggota ini masih memiliki peminjaman buku yang melewati tanggal jatuh tempo.'
        ];
        header('Location: tambah.php');
        exit;
    }

    // TRANSAKSI PDO (Jobsheet 12 Langkah 2)
    $pdo->beginTransaction();

    // Cek ketersediaan dan kunci baris stok buku
    $stmtBuku = $pdo->prepare("SELECT stok FROM buku WHERE id = :id FOR UPDATE");
    $stmtBuku->execute(['id' => $buku_id]);
    $buku = $stmtBuku->fetch(PDO::FETCH_ASSOC);

    if (!$buku || $buku['stok'] <= 0) {
        $pdo->rollBack();
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Stok buku habis atau tidak ditemukan.'];
        header('Location: tambah.php');
        exit;
    }

    // 1. Simpan record peminjaman dengan jatuh tempo 14 hari
    $stmtInsert = $pdo->prepare("INSERT INTO peminjaman (buku_id, anggota_id, tanggal_pinjam, tanggal_jatuh_tempo, status) 
                                VALUES (:buku_id, :anggota_id, CURRENT_DATE, CURRENT_DATE + INTERVAL '14 days', 'dipinjam')");
    $stmtInsert->execute([
        'buku_id' => $buku_id,
        'anggota_id' => $anggota_id
    ]);

    // 2. Kurangi stok buku
    $stmtUpdate = $pdo->prepare("UPDATE buku SET stok = stok - 1 WHERE id = :id");
    $stmtUpdate->execute(['id' => $buku_id]);

    // Commit transaksi
    $pdo->commit();

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjaman berhasil dicatat! Stok buku telah berkurang.'];
    header('Location: riwayat.php');
    exit;

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses peminjaman: ' . $e->getMessage()];
    header('Location: tambah.php');
    exit;
}