<?php
// require_once __DIR__ . '/../includes/auth.php';
$page_title = "Riwayat Peminjaman";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$query = "
    SELECT p.*, a.nama AS nama_anggota, b.judul AS judul_buku 
    FROM peminjaman p
    JOIN anggota a ON p.anggota_id = a.id
    JOIN buku b ON p.buku_id = b.id
    ORDER BY p.id DESC
";
$peminjamanList = $pdo->query($query)->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    .card-box {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    }
    .card-header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    .card-header-flex h2 {
        color: #1d5b8a;
        margin: 0;
        font-size: 1.5rem;
    }
    .btn-primary {
        background-color: #1d5b8a;
        color: #ffffff !important;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
    }
    .custom-table th {
        background-color: #f8f9fa;
        color: #1d5b8a;
        text-align: left;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
        border-bottom: 2px solid #dee2e6;
    }
    .custom-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.9rem;
        color: #495057;
    }
    .custom-table tbody tr:hover {
        background-color: #f1f5f9;
    }

    .badge {
        padding: 0.25rem 0.6rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: bold;
        display: inline-block;
    }
    .badge-success { background-color: #d4edda; color: #155724; }
    .badge-warning { background-color: #fff3cd; color: #856404; }
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
                </tr>
            </thead>
            <tbody>
                <?php if (empty($peminjamanList)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; color: #888;">Belum ada riwayat peminjaman.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($peminjamanList as $p): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($p['nama_anggota'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><strong><?php echo htmlspecialchars($p['judul_buku'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($p['tanggal_pinjam'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($p['tanggal_jatuh_tempo'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($p['tanggal_kembali'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <span class="badge <?php echo ($p['status'] ?? '') === 'dikembalikan' ? 'badge-success' : 'badge-warning'; ?>">
                                    <?php echo htmlspecialchars(ucfirst($p['status'] ?? 'dipinjam'), ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>