<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

// PERBAIKAN 1: Tambahkan filter (status IS NULL OR status = 'Aktif') agar buku nonaktif tidak tampil
if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE (status IS NULL OR status = 'Aktif') AND judul ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku WHERE (status IS NULL OR status = 'Aktif') AND judul ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM buku WHERE status IS NULL OR status = 'Aktif'")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE status IS NULL OR status = 'Aktif' ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
        <section>
            <h2>Daftar Buku</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <form method="get" action="list.php">
                    <span>
                        <label for="search-input">Cari Judul Buku</label><br>
                        <input type="text" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik judul buku...">
                    </span>
                    <button type="submit">Cari</button>
                </form>
            </div>

            <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)): ?>
                    <tr>
                        <td colspan="5">Tidak ada data buku yang cocok.</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($daftarBuku as $buku): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                            <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                            <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                            <td><?php echo htmlspecialchars($buku['stok']); ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $buku['id']; ?>" class="btn-edit">Edit</a>
                                
                                <!-- PERBAIKAN 2: Mengarahkan tombol ke toggle_status.php -->
                                <a href="toggle_status.php?id=<?php echo $buku['id']; ?>&status=Nonaktif" 
                                   onclick="return confirm('Apakah Anda yakin ingin menonaktifkan buku ini?');" 
                                   style="background-color: #d9534f; color: white; padding: 0.35rem 0.7rem; border-radius: 4px; text-decoration: none; font-size: 0.85rem; display: inline-block;">
                                   Nonaktifkan
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>

            <nav class="pagination">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                   class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                <?php endfor; ?>
            </nav>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>