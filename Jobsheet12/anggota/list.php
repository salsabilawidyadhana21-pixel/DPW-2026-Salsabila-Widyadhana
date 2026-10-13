<?php
//require_once __DIR__ . '/../includes/auth.php';//
$page_title = "Daftar Anggota";
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
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :search OR no_anggota ILIKE :search");
    $stmtCount->execute(['search' => "%{$search}%"]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM anggota");
}
$totalRows = (int)$stmtCount->fetchColumn();
$totalPages = ceil($totalRows / $limit);

// Query Ambil Data Anggota
if ($search !== '') {
    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :search OR no_anggota ILIKE :search ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':search', "%{$search}%", PDO::PARAM_STR);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
} else {
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
}
$anggotaList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Daftar Anggota</h2>
        <a href="tambah.php" style="background-color: #1d5b8a; color: white; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none; font-weight: bold;">+ Tambah Anggota</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="get" action="list.php" style="margin-bottom: 1rem; display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Cari nama / no anggota..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; width: 250px;">
        <button type="submit" style="padding: 0.5rem 1rem; background-color: #f0f0f0; border: 1px solid #ccc; border-radius: 4px; cursor: pointer;">Cari</button>
    </form>

    <div class="table-responsive">
        <table border="1" cellpadding="8" cellspacing="0" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>No</th>
                    <th>No Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th style="min-width: 130px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anggotaList)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data anggota.</td>
                    </tr>
                <?php else: ?>
                    <?php $no = $offset + 1; foreach ($anggotaList as $a): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo htmlspecialchars($a['no_anggota'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($a['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['alamat'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['no_hp'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <div style="display: flex; gap: 0.3rem;">
                                    <!-- Tombol Edit -->
                                    <a href="edit.php?id=<?php echo $a['id']; ?>" 
                                       style="background-color: #ffc107; color: #212529; padding: 0.3rem 0.6rem; border-radius: 4px; text-decoration: none; font-size: 0.8rem; font-weight: bold;">
                                       Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <a href="hapus.php?id=<?php echo $a['id']; ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus anggota ini?');" 
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