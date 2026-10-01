<?php

// Memastikan user sudah login
require_once '../includes/auth.php';

// Admin dan petugas boleh menambahkan peminjaman
require_role(['admin', 'petugas']);

// Memanggil CSRF protection
require_once '../includes/csrf.php';

// Koneksi database
require_once '../includes/koneksi.php';

// Mengambil data anggota
$stmtAnggota = $pdo->query(
    "SELECT id, nama, no_anggota
     FROM anggota
     ORDER BY nama ASC"
);
$anggota = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);

// Mengambil buku yang stoknya tersedia
$stmtBuku = $pdo->query(
    "SELECT id, judul, stok
     FROM buku
     WHERE stok > 0
     ORDER BY judul ASC"
);
$buku = $stmtBuku->fetchAll(PDO::FETCH_ASSOC);

// Judul halaman
$page_title = 'Tambah Peminjaman';

// Memanggil header
require_once '../includes/header.php';

$tanggalHariIni = date('Y-m-d');

?>

<section class="page-header">

    <div>
        <span class="section-label">
            Transaksi Buku
        </span>

        <h1>
            Tambah Peminjaman
        </h1>

        <p>
            Catat peminjaman buku oleh anggota perpustakaan.
        </p>
    </div>

    <a href="riwayat.php" class="btn btn-secondary">
        Kembali
    </a>

</section>

<section class="content-card form-card">

    <form action="proses_tambah.php" method="POST">

        <!-- Token CSRF -->
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrf_token(), ENT_QUOTES, 'UTF-8') ?>"
        >

        <!-- Pilih anggota -->
        <div class="form-group">

            <label for="anggota_id">
                Anggota
            </label>

            <select
                id="anggota_id"
                name="anggota_id"
                required
            >
                <option value="">
                    -- Pilih Anggota --
                </option>

                <?php foreach ($anggota as $item): ?>
                    <option value="<?= (int) $item['id'] ?>">
                        <?= htmlspecialchars(
                            $item['nama'] . ' (' . $item['no_anggota'] . ')',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </option>
                <?php endforeach; ?>

            </select>

        </div>

        <!-- Pilih buku -->
        <div class="form-group">

            <label for="buku_id">
                Buku
            </label>

            <select
                id="buku_id"
                name="buku_id"
                required
            >
                <option value="">
                    -- Pilih Buku --
                </option>

                <?php foreach ($buku as $item): ?>
                    <option value="<?= (int) $item['id'] ?>">
                        <?= htmlspecialchars(
                            $item['judul'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                        (Stok: <?= (int) $item['stok'] ?>)
                    </option>
                <?php endforeach; ?>

            </select>

        </div>

        <!-- Tanggal peminjaman -->
        <div class="form-group">

            <label for="tanggal_pinjam">
                Tanggal Peminjaman
            </label>

            <input
                type="date"
                id="tanggal_pinjam"
                name="tanggal_pinjam"
                value="<?= $tanggalHariIni ?>"
                required
            >

        </div>

        <!-- Tanggal jatuh tempo -->
        <div class="form-group">

            <label for="tanggal_jatuh_tempo">
                Tanggal Jatuh Tempo
            </label>

            <input
                type="date"
                id="tanggal_jatuh_tempo"
                name="tanggal_jatuh_tempo"
                min="<?= $tanggalHariIni ?>"
                required
            >

        </div>

        <!-- Tombol form -->
        <div class="form-actions">

            <a
                href="riwayat.php"
                class="btn btn-secondary"
            >
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary"
            >
                Simpan Peminjaman
            </button>

        </div>

    </form>

</section>

<?php

// Memanggil footer
require_once '../includes/footer.php';

?>

