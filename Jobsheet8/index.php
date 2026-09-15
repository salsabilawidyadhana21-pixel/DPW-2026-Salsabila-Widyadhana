<?php

$page_title = "Beranda";

require _DIR_ . 'includes/header.php';
require _DIR_ . 'includes/test_koneksi.php';

$stmtBuku = $pdo->query("SELECT COUNT(*) FROM buku");
$totalBuku = $stmtBuku->fetchColumn();

$stmtAnggota = $pdo->query("SELECT COUNT(*) FROM anggota");
$totalAnggota = $stmtAnggota->fetchColumn();

$totalDipinjam = 0;
?>

<section class="hero">
    <h2>Selamat Datang di SIMPUS-Mini</h2>

    <p>
        Sistem Informasi Perpustakaan Mini
        untuk mengelola data buku dan anggota.
    </p>
</section>

<section class="stats-grid">

    <article class="stat-card">
        <h3>Total Buku</h3>
        <p><?= $totalBuku ?></p>
    </article>

    <article class="stat-card">
        <h3>Total Anggota</h3>
        <p><?= $totalAnggota ?></p>
    </article>

    <article class="stat-card">
        <h3>Sedang Dipinjam</h3>
        <p><?= $totalDipinjam ?></p>
    </article>

</section>

<section>

    <h2>Ringkasan</h2>

    <div class="card-grid">

        <article>
            <h3>Kelola Buku</h3>
            <p>
                Tambahkan dan lihat data buku
                yang tersimpan di PostgreSQL.
            </p>
        </article>

        <article>
            <h3>Kelola Anggota</h3>
            <p>
                Tambahkan dan lihat data anggota
                perpustakaan.
            </p>
        </article>

        <article>
            <h3>Peminjaman</h3>
            <p>
                Fitur peminjaman akan dikembangkan
                pada jobsheet berikutnya.
            </p>
        </article>

    </div>

</section>

<?php require_once 'includes/footer.php'; ?>