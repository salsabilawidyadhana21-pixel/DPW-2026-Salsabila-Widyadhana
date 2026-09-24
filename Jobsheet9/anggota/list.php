<?php

$page_title = 'Daftar Anggota';

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

// Kata kunci pencarian
$keyword = trim($_GET['q'] ?? '');

// Pagination
$perPage = 10;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;

// Menghitung jumlah data anggota
if ($keyword !== '') {
    $stmtCount = $pdo->prepare(
        "SELECT COUNT(*)
         FROM anggota
         WHERE nama ILIKE :keyword
            OR no_anggota ILIKE :keyword"
    );

    $stmtCount->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);
} else {
    $stmtCount = $pdo->query("SELECT COUNT(*) FROM anggota");
}

$totalData = (int) $stmtCount->fetchColumn();
$totalPages = max(1, (int) ceil($totalData / $perPage));

// Mengambil data anggota
if ($keyword !== '') {
    $stmt = $pdo->prepare(
        "SELECT *
         FROM anggota
         WHERE nama ILIKE :keyword
            OR no_anggota ILIKE :keyword
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
         FROM anggota
         ORDER BY id DESC
         LIMIT :limit OFFSET :offset"
    );
}

$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$anggota = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-header">

    <div>
        <span class="section-label">Data Perpustakaan</span>

        <h1>Daftar Anggota</h1>

        <p>
            Kelola data anggota yang tersimpan di database.
        </p>
    </div>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Anggota
    </a>

</section>

<section class="content-card">

    <!-- Pencarian server-side -->
    <form method="GET" class="search-form">

        <input
            type="text"
            id="table-search"
            name="q"
            value="<?= htmlspecialchars($keyword) ?>"
            placeholder="Cari nama atau nomor anggota..."
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
            Total data:
            <strong><?= $totalData ?></strong>
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
                    <th>Nama</th>
                    <th>No. Anggota</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

            <?php if (empty($anggota)): ?>

                <tr>
                    <td colspan="6" class="empty-data">
                        Data anggota tidak ditemukan.
                    </td>
                </tr>

            <?php else: ?>

                <?php foreach ($anggota as $index => $item): ?>

                    <tr>

                        <td>
                            <?= $offset + $index + 1 ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['nama']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['no_anggota']) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['alamat'] ?? '-') ?>
                        </td>

                        <td>
                            <?= htmlspecialchars($item['no_hp'] ?? '-') ?>
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