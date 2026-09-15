<?php

$page_title = "Daftar Buku";

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$sql = "SELECT * FROM buku ORDER BY id DESC";
$stmt = $pdo->query($sql);

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <div class="section-header">
        <h2>Daftar Buku</h2>
        <a href="tambah.php" class="btn">+ Tambah Buku</a>
    </div>

    <?php if ($flash): ?>
        <div class="flash <?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="table-search">Cari Judul Buku</label>
        <input
            type="text"
            id="table-search"
            placeholder="Ketik judul buku..."
        >
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
                        <td colspan="5">
                            Belum ada data buku.
                            Silakan tambah lewat menu "Tambah Buku".
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarBuku as $buku): ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars($buku['judul']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($buku['pengarang']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($buku['tahun']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($buku['stok']) ?>
                            </td>

                            <td>
                                <a href="#" class="btn btn-edit">
                                    Edit
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-hapus"
                                >
                                    Hapus
                                </button>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once '../includes/footer.php'; ?>