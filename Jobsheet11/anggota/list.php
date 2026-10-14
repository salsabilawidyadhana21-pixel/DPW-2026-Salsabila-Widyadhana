<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$search = trim($_GET['search'] ?? $_GET['q'] ?? '');
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
    .btn-danger {
        background-color: #dc3545;
        color: #ffffff !important;
    }
    .btn-danger:hover {
        background-color: #c82333;
    }
</style>

<div class="card-box">
    <div class="card-header-flex">
        <h2>Daftar Anggota</h2>
    </div>

    <?php if ($flash): ?>
        <div style="padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <p style="font-weight: 500; margin-bottom: 0.5rem;">Cari Nama Anggota</p>
    <form method="get" action="list.php" style="margin-bottom: 1.2rem; display: flex; gap: 0.5rem;">
        <input type="text" name="search" placeholder="Ketik nama anggota..." value="<?php echo htmlspecialchars($search, ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.5rem; border: 1px solid #ced4da; border-radius: 4px; width: 260px; font-size: 0.9rem;">
        <button type="submit" class="btn-primary" style="border: none; cursor: pointer;">Cari</button>
    </form>

    <div style="overflow-x: auto;">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>NIM / No Anggota</th>
                    <th>Nama</th>
                    <th>Email / Kontak</th>
                    <th style="min-width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($anggotaList)): ?>
                    <tr>
                        <td colspan="4" style="text-align: center; color: #888;">Tidak ada data anggota.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($anggotaList as $a): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($a['no_anggota'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['alamat'] ?? $a['no_hp'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <div style="display: flex; gap: 0.4rem; align-items: center;">
                                    <a href="edit.php?id=<?php echo $a['id']; ?>" class="btn-action btn-edit">Edit</a>
                                    <a href="hapus.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Yakin ingin menghapus anggota ini?');" class="btn-action btn-danger">Hapus</a>
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