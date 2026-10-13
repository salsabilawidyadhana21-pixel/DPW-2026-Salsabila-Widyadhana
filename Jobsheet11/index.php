<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/koneksi.php';

// Ambil data ringkasan real-time
$totalBuku = (int) $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();

$totalAnggota = 0;
try {
    $totalAnggota = (int) $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
} catch (Exception $e) {
    $totalAnggota = 0;
}

$totalPinjam = 0;
try {
    $totalPinjam = (int) $pdo->query("SELECT COUNT(*) FROM peminjaman WHERE status = 'dipinjam'")->fetchColumn();
} catch (Exception $e) {
    $totalPinjam = 0;
}
?>

<style>
    .welcome-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        margin-bottom: 1.5rem;
    }
    .welcome-card h2 {
        color: #1d5b8a;
        margin-bottom: 0.5rem;
        font-size: 1.6rem;
    }
    .welcome-card p {
        color: #555;
        font-size: 0.95rem;
    }

    .stats-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .stats-card h3 {
        color: #1d5b8a;
        margin-bottom: 1.2rem;
        font-size: 1.2rem;
    }
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }
    .stat-item {
        background: #eef4fa;
        border: 1px solid #d0e1f9;
        padding: 1.5rem;
        border-radius: 8px;
        text-align: center;
    }
    .stat-item h4 {
        color: #444;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
    }
    .stat-item p {
        color: #1d5b8a;
        font-size: 2.2rem;
        font-weight: bold;
        margin: 0;
    }
</style>

<div class="welcome-card">
    <h2>Selamat Datang di Sistem Perpustakaan Mini</h2>
    <p>Aplikasi sederhana untuk mengelola data buku dan anggota perpustakaan.</p>
</div>

<div class="stats-card">
    <h3>Ringkasan Real-Time</h3>
    <div class="stats-grid">
        <div class="stat-item">
            <h4>Total Buku</h4>
            <p><?php echo $totalBuku; ?></p>
        </div>
        <div class="stat-item">
            <h4>Total Anggota</h4>
            <p><?php echo $totalAnggota; ?></p>
        </div>
        <div class="stat-item">
            <h4>Sedang Dipinjam</h4>
            <p><?php echo $totalPinjam; ?></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>