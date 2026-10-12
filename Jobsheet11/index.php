<?php
require_once __DIR__ . '/includes/auth.php';
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Hitung total data ringkasan
$totalBuku = (int) $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = (int) $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();

// Cek jika ada tabel peminjaman
$totalPinjam = 0;
try {
    $totalPinjam = (int) $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'")->fetchColumn();
} catch (Exception $e) {
    $totalPinjam = 0;
}
?>

<section class="welcome-section">
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>
</section>

<section class="summary-section">
    <h3>Ringkasan</h3>
    <div class="stats-grid">
        <div class="stat-card">
            <span class="stat-title">Total Buku</span>
            <span class="stat-value"><?php echo $totalBuku; ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Total Anggota</span>
            <span class="stat-value"><?php echo $totalAnggota; ?></span>
        </div>
        <div class="stat-card">
            <span class="stat-title">Sedang Dipinjam</span>
            <span class="stat-value"><?php echo $totalPinjam; ?></span>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>