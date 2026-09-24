<?php

$page_title = 'Beranda';

require_once 'includes/header.php';
require_once 'includes/koneksi.php';


// Mengambil jumlah buku dari database
$stmtBuku = $pdo->query(
    "SELECT COUNT(*) FROM buku"
);

$totalBuku = $stmtBuku->fetchColumn();


// Mengambil jumlah anggota dari database
$stmtAnggota = $pdo->query(
    "SELECT COUNT(*) FROM anggota"
);

$totalAnggota = $stmtAnggota->fetchColumn();


// Jobsheet 9 belum memiliki fitur peminjaman
$sedangDipinjam = 0;

?>

<section class="welcome-card">

    <h1>
        Selamat Datang di SIMPUS-Mini
    </h1>

    <p>
        Sistem Informasi Perpustakaan Mini
        untuk mengelola data buku dan anggota.
    </p>

</section>


<section class="stats-card">

    <div class="stat-item">

        <strong>Total Buku</strong>

        <span>
            <?= $totalBuku ?>
        </span>

    </div>


    <div class="stat-item">

        <strong>Total Anggota</strong>

        <span>
            <?= $totalAnggota ?>
        </span>

    </div>


    <div class="stat-item">

        <strong>Sedang Dipinjam</strong>

        <span>
            <?= $sedangDipinjam ?>
        </span>

    </div>

</section>


<section class="summary-card">

    <h2>
        Ringkasan
    </h2>


    <div class="summary-item">

        <strong>Total Buku</strong>

        <span>
            <?= $totalBuku ?>
        </span>

    </div>


    <div class="summary-item">

        <strong>Total Anggota</strong>

        <span>
            <?= $totalAnggota ?>
        </span>

    </div>


    <div class="summary-item">

        <strong>Sedang Dipinjam</strong>

        <span>
            <?= $sedangDipinjam ?>
        </span>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>