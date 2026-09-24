<?php

$page_title = 'Daftar Buku';

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

// Kata kunci pencarian
$keyword = trim($_GET['q'] ?? '');

// Pagination
$perPage = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

// Menghitung jumlah data
if ($keyword !== '') {
    $stmtCount = $pdo->prepare(
        "SELECT COUNT(*)
         FROM buku
         WHERE judul ILIKE :keyword"
    );

    $stmtCount->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM buku");
}

$totalData = (int) $stmtCount->fetchColumn();
$totalPages = max(1, (int) ceil($totalData / $perPage));

// Mengambil data buku
if ($keyword !== '') {
    $stmt = $pdo->prepare(
        "SELECT *
         FROM buku
         WHERE judul ILIKE :keyword
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );

    $stmt->bindValue(
        ':keyword',
        '%' . $keyword . '%',
        PDO::PARAM_STR
    );
} else {
    $stmt = $pdo->prepare(
        "SELECT *
         FROM buku
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );
}

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$buku = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-header">
    <div>
        <span class="section-label">Data Perpustakaan</span>
        <h1>Daftar Buku</h1>
        <p>
            Kelola data buku yang tersimpan di database.
        </p>
    </div>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Buku
    </a>
</section>

<section class="content-card">

    <!-- Form pencarian server-side -->
    <form method="GET" class="search-form">

        <input
            type="text"
            id="table-search"
            name="q"
            value="<?= htmlspecialchars($keyword) ?>"
            placeholder="Cari berdasarkan judul buku..."
        >

        <button type="submit" class="btn btn-primary">
            Cari
        </button>

        <?php if ($keyword !== ''): ?>
            <a href="list.php" class="btn btn-secondary">
                Reset
            </a>
        <?php endif; ?>

    </form>

    <div class="table-info">
        <span>
            Total data: <strong><?= $totalData ?></strong>
        </span>

        <?php if ($keyword !== ''): ?>
            <span>
                Hasil pencarian:
                <strong><?= htmlspecialchars($keyword) ?></strong>
            </span>
        <?php endif; ?>
    </div>

    <div class="table-responsive">

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if (empty($buku)): ?>

                <tr>
                    <td colspan="8" class="empty-data">
                        Data buku tidak ditemukan.
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach ($buku as $index => $item): ?>

                    <tr>
                        <td>
                            <?= $offset + $index + 1 ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['judul']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['pengarang']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['tahun']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['isbn'] ?? '-') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['stok']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['kategori'] ?? '-') ?>
                        </td>

                        <td>
                            <div class="action-buttons">

                                <a
                                    href="edit.php?id=<?= $item['id'] ?>"
                                    class="btn btn-small btn-edit">
                                    Edit
                                </a>

                                <!-- Hapus menggunakan POST -->
                                <form
                                    action="hapus.php"
                                    method="POST"
                                    class="form-hapus">

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= $item['id'] ?>"
                                    >

                                    <button
                                        type="submit"
                                        class="btn btn-small btn-hapus">
                                        Hapus
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                <?php endforeach; ?>

            <?php endif; ?>

            </tbody>
        </table>

    </div>

    <!-- Pagination -->
    <?php if ($totalPages > 1): ?>

        <div class="pagination">

            <?php if ($page > 1): ?>

                <a
                    href="?q=<?= urlencode($keyword) ?>&page=<?= $page - 1 ?>"
                    class="btn btn-secondary">
                    ← Sebelumnya
                </a>

            <?php endif; ?>

            <span>
                Halaman <?= $page ?> dari <?= $totalPages ?>
            </span>

            <?php if ($page < $totalPages): ?>

                <a
                    href="?q=<?= urlencode($keyword) ?>&page=<?= $page + 1 ?>"
                    class="btn btn-secondary">
                    Berikutnya →
                </a>

            <?php endif; ?>

        </div>

    <?php endif; ?>

</section>

<?php require_once '../includes/footer.php'; ?>