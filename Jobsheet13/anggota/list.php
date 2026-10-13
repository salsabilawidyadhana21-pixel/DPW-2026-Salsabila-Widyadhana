<?php
// require_once __DIR__ . '/../includes/auth.php';
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$search = trim($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

if ($search !== '') {
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :search OR no_anggota ILIKE :search");
    $stmtCount->execute(['search' => "%{$search}%"]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM anggota");
}
$totalRows = (int)$stmtCount->fetchColumn();
$totalPages = ceil($totalRows / $limit);

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
    .btn-primary:hover { opacity: 0.9; }

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

    .action-btn {
        padding: 0.3rem 0.65rem;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: bold;
        display: inline-block;
    }
    .btn-warning { background-color: #ffc107; color: #212529 !important; }
    .btn-danger { background-color: #dc3545; color: #ffffff !important; }
</style>

<div class="card-box">
    <div class="card-header-flex">
        <h2>Daftar Anggota</h2>
        <a href="tambah.php" class="btn-primary">+ Tambah Anggota</a>
    </div>

    <?php if ($flash): ?>
        <div style="padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <form method="get" action="list.php" style="margin-bottom: 1.2rem; display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Cari nama / no anggota..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.5rem; border: 1px solid #ced4da; border-radius: 4px; width: 260px; font-size: 0.9rem;">
        <button type="submit" style="padding: 0.5rem 1rem; background-color: #e9ecef; border: 1px solid #ced4da; border-radius: 4px; cursor: pointer; font-weight: 500;">Cari</button>
    </form>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
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
                        <td colspan="6" style="text-align: center; color: #888;">Tidak ada data anggota.</td>
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
                                    <a href="edit.php?id=<?php echo $a['id']; ?>" class="action-btn btn-warning">Edit</a>
                                    <a href="hapus.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?');" class="action-btn btn-danger">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div style="margin-top: 1.5rem; display: flex; gap: 0.3rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" 
                   style="padding: 0.4rem 0.8rem; border: 1px solid #ced4da; text-decoration: none; border-radius: 4px; font-size: 0.85rem; <?php echo $i === $page ? 'background-color: #1d5b8a; color: white; border-color: #1d5b8a;' : 'color: #333; background: #fff;'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>