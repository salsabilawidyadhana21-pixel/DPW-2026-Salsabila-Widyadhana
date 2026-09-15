<?php

$page_title = "Daftar Anggota";

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$sql = "SELECT * FROM anggota ORDER BY id DESC";
$stmt = $pdo->query($sql);

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<section>

    <div class="section-header">
        <h2>Daftar Anggota</h2>

        <a href="tambah.php" class="btn">
            + Tambah Anggota
        </a>
    </div>

    <?php if ($flash): ?>

        <div class="flash <?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </div>

    <?php endif; ?>

    <div class="form-group">
        <label for="table-search">
            Cari Nama Anggota
        </label>

        <input
            type="text"
            id="table-search"
            placeholder="Ketik nama anggota..."
        >
    </div>

    <div class="table-responsive">

        <table>

            <thead>
                <tr>
                    <th>No. Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if (empty($daftarAnggota)): ?>

                    <tr>
                        <td colspan="5">
                            Belum ada data anggota.
                            Silakan tambah lewat menu "Tambah Anggota".
                        </td>
                    </tr>

                <?php else: ?>

                    <?php foreach ($daftarAnggota as $anggota): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars($anggota['no_anggota']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['alamat']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($anggota['no_hp']) ?>
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