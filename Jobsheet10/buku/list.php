<?php

require_once '../includes/auth.php';
require_role(['admin', 'petugas']);

require_once '../includes/koneksi.php';

$page_title = 'Data Buku';

require_once '../includes/header.php';

// =====================================================
// SEARCH
// =====================================================

$keyword = $_GET['keyword'] ?? '';

if ($keyword !== '') {

    $sql = "
        SELECT *
        FROM buku
        WHERE judul ILIKE :keyword
           OR pengarang ILIKE :keyword
           OR isbn ILIKE :keyword
           OR kategori ILIKE :keyword
        ORDER BY id DESC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);

} else {

    $sql = "
        SELECT *
        FROM buku
        ORDER BY id DESC
    ";

    $stmt = $pdo->query($sql);
}

$buku = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-header">

    <div>

        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Data Buku
        </h1>

        <p>
            Kelola data buku perpustakaan.
        </p>

    </div>

    <a
        href="tambah.php"
        class="btn btn-primary">

        + Tambah Buku

    </a>

</section>


<section class="content-card">

    <form
        method="GET"
        class="search-box">

        <input
            type="text"
            name="keyword"
            placeholder="Cari buku..."
            value="<?= htmlspecialchars($keyword) ?>">

        <button
            type="submit"
            class="btn btn-primary">

            Cari

        </button>

        <?php if ($keyword !== ''): ?>

            <a
                href="list.php"
                class="btn btn-secondary">

                Reset

            </a>

        <?php endif; ?>

    </form>


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

                <?php if (count($buku) > 0): ?>

                    <?php foreach ($buku as $index => $data): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['judul']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['pengarang']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['tahun']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['isbn'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['stok']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['kategori'] ?? '-') ?>
                            </td>

                            <td>

                                <a
                                    href="edit.php?id=<?= $data['id'] ?>"
                                    class="btn btn-edit">

                                    Edit

                                </a>

                                <a
                                    href="hapus.php?id=<?= $data['id'] ?>"
                                    class="btn btn-hapus"
                                    onclick="return confirm('Yakin ingin menghapus data buku ini?');">

                                    Hapus

                                </a>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="8"
                            style="text-align: center;">

                            Data buku tidak ditemukan.

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</section>


<?php

require_once '../includes/footer.php';

?>