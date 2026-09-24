<?php

require_once '../includes/auth.php';
require_role(['admin', 'petugas']);

require_once '../includes/koneksi.php';

$page_title = 'Data Anggota';

require_once '../includes/header.php';

$keyword = $_GET['keyword'] ?? '';

if ($keyword !== '') {

    $sql = "
        SELECT *
        FROM anggota
        WHERE nama ILIKE :keyword
           OR no_anggota ILIKE :keyword
           OR alamat ILIKE :keyword
           OR no_hp ILIKE :keyword
        ORDER BY id DESC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);

} else {

    $sql = "
        SELECT *
        FROM anggota
        ORDER BY id DESC
    ";

    $stmt = $pdo->query($sql);
}

$anggota = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<section class="page-header">

    <div>

        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Data Anggota
        </h1>

        <p>
            Kelola data anggota perpustakaan.
        </p>

    </div>

    <a
        href="tambah.php"
        class="btn btn-primary">

        + Tambah Anggota

    </a>

</section>


<section class="content-card">

    <form
        method="GET"
        class="search-box">

        <input
            type="text"
            name="keyword"
            placeholder="Cari anggota..."
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
                    <th>Nama</th>
                    <th>No. Anggota</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

                <?php if (count($anggota) > 0): ?>

                    <?php foreach ($anggota as $index => $data): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['no_anggota']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['alamat'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['no_hp'] ?? '-') ?>
                            </td>

                            <td>

                                <a
                                    href="edit.php?id=<?= $data['id'] ?>"
                                    class="btn btn-edit">

                                    Edit

                                </a>


                                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>

                                    <a
                                        href="hapus.php?id=<?= $data['id'] ?>"
                                        class="btn btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus data anggota ini?');">

                                        Hapus

                                    </a>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td
                            colspan="6"
                            style="text-align: center;">

                            Data anggota tidak ditemukan.

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