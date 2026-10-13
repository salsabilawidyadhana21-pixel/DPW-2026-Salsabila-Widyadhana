<?php
require_once __DIR__ . '/../includes/auth.php';
$page_title = "Riwayat Peminjaman";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Query JOIN 3 tabel (peminjaman, buku, anggota) - Jobsheet 12 Langkah 4
$sql = "SELECT p.*, b.judul, a.nama AS nama_anggota, a.no_anggota 
        FROM peminjaman p 
        JOIN buku b ON p.buku_id = b.id 
        JOIN anggota a ON p.anggota_id = a.id 
        ORDER BY p.id DESC";

$stmt = $pdo->query($sql);
$riwayat = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Riwayat Peminjaman Buku</h2>
        <a href="tambah.php" style="background-color: #1d5b8a; color: white; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none;">+ Pinjam Buku Baru</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <div class="table-responsive">
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
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
                        <td colspan="8" style="text-align: center;">Belum ada riwayat peminjaman.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($riwayat as $r): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($r['nama_anggota'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['judul'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['tanggal_pinjam'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['tanggal_jatuh_tempo'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($r['tanggal_kembali'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <?php if ($r['status'] === 'dipinjam'): ?>
                                    <span style="color: #d9534f; font-weight: bold;">Dipinjam</span>
                                <?php else: ?>
                                    <span style="color: #5cb85c; font-weight: bold;">Dikembalikan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($r['status'] === 'dipinjam'): ?>
                                    <a href="kembali.php?id=<?php echo $r['id']; ?>" 
                                       onclick="return confirm('Apakah buku ini sudah dikembalikan?');" 
                                       style="background-color: #5cb85c; color: white; padding: 0.35rem 0.7rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem;">
                                       Kembalikan
                                    </a>
                                <?php else: ?>
                                    <span style="color: #777;">-</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>