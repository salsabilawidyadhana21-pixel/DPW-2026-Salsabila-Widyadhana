<?php

// Memastikan user sudah login
require_once 'includes/auth.php';

// Admin dan petugas boleh mengakses dashboard
require_role(['admin', 'petugas']);

// Koneksi database
require_once 'includes/koneksi.php';

// Judul halaman
$page_title = 'Dashboard';

// Menghitung jumlah buku
$stmtBuku = $pdo->query(
    "SELECT COUNT(*) FROM buku"
);
$totalBuku = $stmtBuku->fetchColumn();

// Menghitung total stok buku
$stmtStok = $pdo->query(
    "SELECT COALESCE(SUM(stok), 0) FROM buku"
);
$totalStok = $stmtStok->fetchColumn();

// Menghitung jumlah anggota
$stmtAnggota = $pdo->query(
    "SELECT COUNT(*) FROM anggota"
);
$totalAnggota = $stmtAnggota->fetchColumn();

// Menghitung peminjaman yang masih aktif
$stmtDipinjam = $pdo->query(
    "SELECT COUNT(*)
     FROM peminjaman
     WHERE status = 'dipinjam'"
);
$totalDipinjam = $stmtDipinjam->fetchColumn();

// Menghitung buku yang sudah dikembalikan
$stmtDikembalikan = $pdo->query(
    "SELECT COUNT(*)
     FROM peminjaman
     WHERE status = 'dikembalikan'"
);
$totalDikembalikan = $stmtDikembalikan->fetchColumn();

// Menghitung peminjaman yang terlambat
$stmtTerlambat = $pdo->query(
    "SELECT COUNT(*)
     FROM peminjaman
     WHERE status = 'dipinjam'
       AND tanggal_jatuh_tempo < CURRENT_DATE"
);
$totalTerlambat = $stmtTerlambat->fetchColumn();

// Memanggil header
require_once 'includes/header.php';

?>

<section class="page-header">

    <div>
        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Dashboard
        </h1>

        <p>
            Selamat datang di Sistem Informasi Perpustakaan Mini.
        </p>
    </div>

</section>

<!-- Ringkasan data -->
<section class="dashboard-grid">

    <div class="content-card">
        <span class="section-label">
            Total Buku
        </span>

        <h2>
            <?= (int) $totalBuku ?>
        </h2>

        <p>
            Judul buku terdaftar
        </p>

        <a href="buku/list.php" class="btn btn-secondary">
            Lihat Buku
        </a>
    </div>

    <div class="content-card">
        <span class="section-label">
            Stok Buku
        </span>

        <h2>
            <?= (int) $totalStok ?>
        </h2>

        <p>
            Buku tersedia di perpustakaan
        </p>

        <a href="buku/list.php" class="btn btn-secondary">
            Lihat Stok
        </a>
    </div>

    <div class="content-card">
        <span class="section-label">
            Total Anggota
        </span>

        <h2>
            <?= (int) $totalAnggota ?>
        </h2>

        <p>
            Anggota terdaftar
        </p>

        <a href="anggota/list.php" class="btn btn-secondary">
            Lihat Anggota
        </a>
    </div>

    <div class="content-card">
        <span class="section-label">
            Sedang Dipinjam
        </span>

        <h2>
            <?= (int) $totalDipinjam ?>
        </h2>

        <p>
            Transaksi peminjaman aktif
        </p>

        <a href="peminjaman/riwayat.php" class="btn btn-secondary">
            Lihat Peminjaman
        </a>
    </div>

    <div class="content-card">
        <span class="section-label">
            Sudah Dikembalikan
        </span>

        <h2>
            <?= (int) $totalDikembalikan ?>
        </h2>

        <p>
            Transaksi selesai
        </p>

        <a href="peminjaman/riwayat.php" class="btn btn-secondary">
            Lihat Riwayat
        </a>
    </div>

    <div class="content-card">
        <span class="section-label">
            Terlambat
        </span>

        <h2>
            <?= (int) $totalTerlambat ?>
        </h2>

        <p>
            Peminjaman melewati jatuh tempo
        </p>

        <a href="peminjaman/riwayat.php" class="btn btn-secondary">
            Periksa Riwayat
        </a>
    </div>

</section>

<!-- Menu utama -->
<section class="content-card">

    <h2>
        Menu Utama
    </h2>

    <p>
        Pilih menu untuk mengelola data perpustakaan.
    </p>

    <div class="form-actions">

        <a href="buku/list.php" class="btn btn-primary">
            Data Buku
        </a>

        <a href="anggota/list.php" class="btn btn-primary">
            Data Anggota
        </a>

        <a href="peminjaman/tambah.php" class="btn btn-primary">
            Tambah Peminjaman
        </a>

        <a href="peminjaman/riwayat.php" class="btn btn-primary">
            Riwayat Peminjaman
        </a>

    </div>

</section>

<?php

// Memanggil footer
require_once 'includes/footer.php';

?>

