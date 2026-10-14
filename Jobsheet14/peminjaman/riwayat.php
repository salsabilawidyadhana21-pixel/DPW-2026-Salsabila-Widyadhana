<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'];
    header('Location: ../auth/login.php');
    exit;
}

$page_title = "Riwayat Peminjaman";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$sql = "SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku 
        FROM peminjaman p
        JOIN anggota a ON p.anggota_id = a.id
        JOIN buku b ON p.buku_id = b.id
        ORDER BY p.id DESC";
$stmt = $pdo->query($sql);
$riwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .card-box { background: #ffffff; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.06); }
    .card-header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; }
    .card-header-flex h2 { color: #1d5b8a; margin: 0; font-size: 1.5rem; }
    .btn-primary { background-color: #1d5b8a; color: #ffffff !important; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 0.9rem; }
    .custom-table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    .custom-table th { background-color: #f8f9fa; color: #1d5b8a; text-align: left; padding: 0.8rem 1rem; font-size: 0.9rem; border-bottom: 2px solid #dee2e6; }
    .custom-table td { padding: 0.8rem 1rem; border-bottom: 1px solid #e9ecef; font-size: 0.95rem; color: #333; }
    .badge { display: inline-block; padding: 0.35rem 0.65rem; border-radius: 4px; font-size: 0.8rem; font-weight: bold; }
    .badge-warning { background-color: #fff3cd; color: #856404; }
    .badge-success { background-color: #d4edda; color: #155724; }
    .btn-return { background-color: #28a745; color: #ffffff !important; padding: 0.35rem 0.75rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem; font-weight: bold; display: inline-block; }
</style>

<div class="card-box">
    <div class="card-header-flex">
        <h2>Riwayat Peminjaman Buku</h2>
        <a href="tambah.php" class="btn-primary">+ Pinjam Buku Baru</a>
    </div>

    <?php if ($flash): ?>
        <div style="padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Judul Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($riwayat)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center; color: #888;">Belum ada riwayat peminjaman.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($riwayat as $r): ?>
                        <?php 
                            $statusClean = strtolower(trim($r['status'] ?? '')); 
                            $isDipinjam = ($statusClean === 'dipinjam');
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($r['nama_anggota'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><strong><?php echo htmlspecialchars($r['judul_buku'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($r['tgl_pinjam'] ?? $r['tanggal_pinjam'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['tgl_jatuh_tempo'] ?? $r['jatuh_tempo'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['tgl_kembali'] ?? $r['tanggal_kembali'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <span class="badge <?php echo $isDipinjam ? 'badge-warning' : 'badge-success'; ?>">
                                    <?php echo ucfirst($r['status']); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($isDipinjam): ?>
                                    <a href="kembali.php?id=<?php echo $r['id']; ?>" 
                                       onclick="return confirm('Proses pengembalian buku ini?');" 
                                       class="btn-return">
                                       Kembalikan
                                    </a>
                                <?php else: ?>
                                    <span style="color: #aa1203; font-size: 0.85rem;">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>