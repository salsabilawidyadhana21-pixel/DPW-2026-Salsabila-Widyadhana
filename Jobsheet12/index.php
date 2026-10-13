<?php
require_once __DIR__ . '/includes/auth.php';
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$totalBuku = (int) $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = (int) $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();

// Menghitung angka real dari database untuk peminjaman aktif
$totalPinjam = 0;
try {
    $totalPinjam = (int) $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'")->fetchColumn();
} catch (Exception $e) {
    $totalPinjam = 0;
}
?>

<section class="welcome-section">
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku, anggota, serta transaksi peminjaman perpustakaan.</p>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-top: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>
</section>

<section class="summary-section">
    <h3>Ringkasan Real-Time</h3>
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Buku</h3>
            <p><?php echo $totalBuku; ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Anggota</h3>
            <p><?php echo $totalAnggota; ?></p>
        </div>
        <div class="stat-card">
            <h3>Sedang Dipinjam</h3>
            <p><?php echo $totalPinjam; ?></p>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>