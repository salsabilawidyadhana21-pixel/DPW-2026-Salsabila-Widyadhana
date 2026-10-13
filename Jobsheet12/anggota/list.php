<?php
require_once __DIR__ . '/../includes/auth.php';
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw OR no_anggota ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :kw OR no_anggota ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
<section>
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
        <h2>Daftar Anggota</h2>
        <a href="tambah.php" style="background-color: #1d5b8a; color: white; padding: 0.5rem 1rem; border-radius: 4px; text-decoration: none;">+ Tambah Anggota</a>
    </div>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="get" action="list.php" style="margin-bottom: 1rem;">
        <input type="text" name="q" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Cari nama / no anggota..." style="padding: 0.5rem; width: 250px;">
        <button type="submit" style="padding: 0.5rem 1rem;">Cari</button>
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
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($daftarAnggota)): ?>
                    <tr><td colspan="6" style="text-align: center;">Tidak ada data anggota.</td></tr>
                <?php else: ?>
                    <?php $no = $offset + 1; foreach ($daftarAnggota as $a): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><strong><?php echo htmlspecialchars($a['no_anggota'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></strong></td>
                            <td><?php echo htmlspecialchars($a['nama'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['alamat'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td><?php echo htmlspecialchars($a['no_hp'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $a['id']; ?>">Edit</a> | 
                                <a href="hapus.php?id=<?php echo $a['id']; ?>" onclick="return confirm('Yakin hapus anggota ini?');" style="color: red;">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if ($totalPages > 1): ?>
        <div style="margin-top: 1rem;">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?>&q=<?php echo urlencode($keyword); ?>" style="padding: 0.25rem 0.5rem; border: 1px solid #ccc; <?php echo $i === $page ? 'background: #1d5b8a; color: white;' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>