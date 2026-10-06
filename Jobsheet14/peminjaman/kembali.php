<?php

// Memastikan user sudah login
require_once '../includes/auth.php';

// Admin dan petugas boleh memproses pengembalian
require_role(['admin', 'petugas']);

// Memanggil CSRF protection
require_once '../includes/csrf.php';

// Koneksi database
require_once '../includes/koneksi.php';

// Mengambil ID peminjaman dari URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('ID peminjaman tidak valid.');
}

// Mengambil data peminjaman, buku, dan anggota
$stmt = $pdo->prepare(
    "SELECT
        p.id,
        p.tanggal_pinjam,
        p.tanggal_jatuh_tempo,
        p.status,
        b.judul,
        a.nama,
        a.no_anggota
     FROM peminjaman p
     INNER JOIN buku b ON p.buku_id = b.id
     INNER JOIN anggota a ON p.anggota_id = a.id
     WHERE p.id = :id"
);

$stmt->execute([
    ':id' => $id
]);

$peminjaman = $stmt->fetch(PDO::FETCH_ASSOC);

// Memastikan data peminjaman ditemukan
if (!$peminjaman) {
    exit('Data peminjaman tidak ditemukan.');
}

// Memastikan buku masih berstatus dipinjam
if ($peminjaman['status'] !== 'dipinjam') {
    exit('Buku ini sudah dikembalikan.');
}

// Judul halaman
$page_title = 'Pengembalian Buku';

// Memanggil header
require_once '../includes/header.php';

?>

<section class="page-header">

    <div>
        <span class="section-label">
            Transaksi Buku
        </span>

        <h1>
            Pengembalian Buku
        </h1>

        <p>
            Periksa data peminjaman sebelum mengonfirmasi pengembalian.
        </p>
    </div>

    <a href="riwayat.php" class="btn btn-secondary">
        Kembali
    </a>

</section>

<section class="content-card form-card">

    <h2>
        Detail Peminjaman
    </h2>

    <div class="form-group">
        <label>Nama Anggota</label>
        <p>
            <?= htmlspecialchars(
                $peminjaman['nama'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </div>

    <div class="form-group">
        <label>Nomor Anggota</label>
        <p>
            <?= htmlspecialchars(
                $peminjaman['no_anggota'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </div>

    <div class="form-group">
        <label>Judul Buku</label>
        <p>
            <?= htmlspecialchars(
                $peminjaman['judul'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </div>

    <div class="form-group">
        <label>Tanggal Peminjaman</label>
        <p>
            <?= htmlspecialchars(
                $peminjaman['tanggal_pinjam'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </div>

    <div class="form-group">
        <label>Tanggal Jatuh Tempo</label>
        <p>
            <?= htmlspecialchars(
                $peminjaman['tanggal_jatuh_tempo'],
                ENT_QUOTES,
                'UTF-8'
            ) ?>
        </p>
    </div>

    <div class="form-group">
        <label>Status</label>
        <p>
            Dipinjam
        </p>
    </div>

    <!-- Form konfirmasi pengembalian -->
    <form action="proses_kembali.php" method="POST">

        <!-- Token CSRF -->
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(
                csrf_token(),
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
        >

        <!-- ID peminjaman -->
        <input
            type="hidden"
            name="id"
            value="<?= (int) $peminjaman['id'] ?>"
        >

        <div class="form-actions">

            <a
                href="riwayat.php"
                class="btn btn-secondary">

                Batal

            </a>

            <button
                type="submit"
                class="btn btn-primary">

                Konfirmasi Pengembalian

            </button>

        </div>

    </form>

</section>

<?php

// Memanggil footer
require_once '../includes/footer.php';

?>

