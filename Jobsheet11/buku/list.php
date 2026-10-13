<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$search = trim($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$limit = 5;
$offset = ($page - 1) * $limit;

if ($search !== '') {
    $stmtCount = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :search OR pengarang ILIKE :search");
    $stmtCount->execute(['search' => "%{$search}%"]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM buku");
}
$totalRows = (int)$stmtCount->fetchColumn();
$totalPages = ceil($totalRows / $limit);

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
        background-color: #1d5b8a;
        color: #ffffff;
        text-align: left;
        padding: 0.75rem 1rem;
        font-size: 0.9rem;
    }
    .custom-table td {
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.9rem;
        color: #495057;
    }
    .custom-table tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    /* Styling Tombol Aksi */
    .btn-action {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 4px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: bold;
        line-height: 1.2;
        text-align: center;
    }
    .btn-edit {
        background-color: #ffc107;
        color: #212529 !important;
    }
    .btn-edit:hover {
        background-color: #e0a800;
    }
    .btn-toggle {
        background-color: #dc3545;
        color: #ffffff !important;
    }
    .btn-toggle:hover {
        background-color: #c82333;
    }
    .btn-toggle-active {
        background-color: #28a745;
        color: #ffffff !important;
    }
</style>

<div class="card-box">
    <div class="card-header-flex">
        <h2>Daftar Buku</h2>
    </div>

    <?php if ($flash): ?>
        <div style="padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <p style="font-weight: 500; margin-bottom: 0.5rem;">Cari Judul Buku</p>
    <form method="get" action="list.php" style="margin-bottom: 1.2rem; display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Ketik judul buku..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.5rem; border: 1px solid #ced4da; border-radius: 4px; width: 260px; font-size: 0.9rem;">
        <button type="submit" class="btn-primary" style="border: none; cursor: pointer;">Cari</button>
    </form>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th style="min-width: 180px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bukuList)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: #888;">Tidak ada data buku.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($bukuList as $b): ?>
                        <?php $status = $b['status'] ?? 'Aktif'; ?>
                        <tr>
                            <td><?php echo htmlspecialchars($b['judul'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($b['pengarang'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($b['tahun_terbit'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><strong><?php echo htmlspecialchars($b['stok'], ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td>
                                <div style="display: flex; gap: 0.4rem; align-items: center;">
                                    <a href="edit.php?id=<?php echo $b['id']; ?>" class="btn-action btn-edit">Edit</a>
                                    <a href="toggle_status.php?id=<?php echo $b['id']; ?>" onclick="return confirm('Ubah status buku ini?');" class="btn-action <?php echo $status === 'Aktif' ? 'btn-toggle' : 'btn-toggle-active'; ?>">
                                        <?php echo $status === 'Aktif' ? 'Nonaktifkan' : 'Aktifkan'; ?>
                                    </a>
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
                   style="padding: 0.4rem 0.8rem; border: 1px solid #ced4da; text-decoration: none; border-radius: 4px; font-size: 0.85rem; <?php echo $i === $page ? 'background-color: #1d5b8a; color: white; border-color: #1d5b8a;' : 'color: #1d5b8a; background: #fff;'; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>