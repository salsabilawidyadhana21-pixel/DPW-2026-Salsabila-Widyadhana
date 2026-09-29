<?php

// Memastikan user sudah login
require_once '../includes/auth.php';

// Admin dan petugas boleh melihat riwayat
require_role(['admin', 'petugas']);

// Koneksi database
require_once '../includes/koneksi.php';

// Judul halaman
$page_title = 'Riwayat Peminjaman';

// Mengambil data peminjaman beserta buku dan anggota
$stmt = $pdo->query(
    "SELECT
        p.id,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        p.tanggal_kembali,
        p.status,
        b.judul,
        a.nama,
        a.no_anggota
     FROM peminjaman p
     INNER JOIN buku b ON p.buku_id = b.id
     INNER JOIN anggota a ON p.anggota_id = a.id
     ORDER BY p.id DESC"
);

$peminjaman = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Memanggil header
require_once '../includes/header.php';

?>

<section class="page-header">

    <div>
        <span class="section-label">
            Transaksi Buku
        </span>

        <h1>
            Riwayat Peminjaman
        </h1>

        <p>
            Daftar transaksi peminjaman dan pengembalian buku.
        </p>
    </div>

    <a href="tambah.php" class="btn btn-primary">
        + Tambah Peminjaman
    </a>

</section>

<section class="content-card">

    <h2>
        Data Peminjaman
    </h2>

    <?php if (count($peminjaman) > 0): ?>

        <div class="table-container">

            <table>

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Anggota</th>
                        <th>Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
                        <th>Tanggal Kembali</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($peminjaman as $index => $item): ?>

                        <tr>

                            <td>
                                <?= $index + 1 ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $item['nama'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>

                                <br>

                                <small>
                                    <?= htmlspecialchars(
                                        $item['no_anggota'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    ) ?>
                                </small>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $item['judul'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $item['tanggal_pinjam'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $item['tanggal_jatuh_tempo'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ) ?>
                            </td>

                            <td>
                                <?= $item['tanggal_kembali']
                                    ? htmlspecialchars(
                                        $item['tanggal_kembali'],
                                        ENT_QUOTES,
                                        'UTF-8'
                                    )
                                    : '-' ?>
                            </td>

                            <td>
                                <?php if ($item['status'] === 'dikembalikan'): ?>

                                    <span class="status-badge status-success">
                                        Dikembalikan
                                    </span>

                                <?php else: ?>

                                    <span class="status-badge status-warning">
                                        Dipinjam
                                    </span>

                                <?php endif; ?>
                            </td>

                            <td>

                                <?php if ($item['status'] === 'dipinjam'): ?>

                                    <a
                                        href="kembali.php?id=<?= (int) $item['id'] ?>"
                                        class="btn btn-secondary">

                                        Kembalikan

                                    </a>

                                <?php else: ?>

                                    <span>-</span>

                                <?php endif; ?>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php else: ?>

        <p>
            Belum ada data peminjaman.
        </p>

    <?php endif; ?>

</section>

<?php

// Memanggil footer
require_once '../includes/footer.php';

?>

