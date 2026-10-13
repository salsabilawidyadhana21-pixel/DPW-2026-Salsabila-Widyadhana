<?php
//require_once __DIR__ . '/../includes/auth.php';//
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

// Fitur Pencarian & Pagination
$search = trim($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

// Query Hitung Total Data
if ($search !== '') {
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :search OR pengarang ILIKE :search");
    $stmtCount->execute(['search' => "%{$search}%"]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM buku");
}
$totalRows = (int)$stmtCount->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Query Ambil Data Buku
if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :search OR pengarang ILIKE :search ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}
$bukuList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Daftar Buku</h2>
        <a href="tambah.php" style="background-color: #1d5b8a; color: white; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-weight: bold;">+ Tambah Buku</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="get" action="list.php" style="margin-bottom: 1rem; display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Cari judul atau pengarang..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; width: 250px;">
        <button type="submit" style="padding: 0.5rem 1rem; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Cari</button>
    </form>

    <div class="table-responsive">
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Stok</th>
                    <th>Status</th>
                    <th style="min-width: 220px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bukuList)): ?>
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada data buku.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = $offset + 1; foreach ($bukuList as $b): ?>
                        <?php $status = $b['status'] ?? 'Aktif'; ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($b['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($b['pengarang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($b['tahun_terbit'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($b['isbn'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><strong><?php echo htmlspecialchars($b['stok'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td>
                                <span style="background-color: <?php echo $status === 'Aktif' ? '#d4edda' : '#f8d7da'; ?>; color: <?php echo $status === 'Aktif' ? '#155724' : '#721c24'; ?>; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.85rem; font-weight: bold;">
                                    <?php echo htmlspecialchars($status, ENT_QUOTES, 'UTF-8'); ?>
                                </span>
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.3rem; flex-wrap: wrap;">
                                    <!-- Tombol Edit -->
                                    <a href="edit.php?id=<?php echo $b['id']; ?>" 
                                       style="background-color: #ffc107; color: #212529; padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem; font-weight: bold;">
                                       Edit
                                    </a>

                                    <!-- Tombol Toggle Status -->
                                    <a href="toggle_status.php?id=<?php echo $b['id']; ?>" 
                                       onclick="return confirm('Ubah status buku ini?');" 
                                       style="background-color: <?php echo $status === 'Aktif' ? '#6c757d' : '#28a745'; ?>; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem; font-weight: bold;">
                                       <?php echo $status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <a href="hapus.php?id=<?php echo $b['id']; ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?');" 
                                       style="background-color: #dc3545; color: white; padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem; font-weight: bold;">
                                       Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Navigasi Pagination -->
    <?php if ($totalPages > 1): ?>
        <div style="margin-top: 1rem; display: flex; gap: 0.25rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" 
                   style="padding: 0.3rem 0.6rem; border: 1px solid #ccc; text-decoration: none; border-radius: 3px; <?php echo $i === $page ? 'background-color: #1d5b8a; color: white;' : 'color: #333;'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>