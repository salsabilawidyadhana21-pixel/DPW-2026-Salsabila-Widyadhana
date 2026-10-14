<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Silakan login terlebih dahulu.'];
    header('Location: ../auth/login.php');
    exit;
}

require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $anggota_id     = trim($_POST['anggota_id'] ?? '');
    $buku_id        = trim($_POST['buku_id'] ?? '');
    $tanggal_pinjam = trim($_POST['tgl_pinjam'] ?? $_POST['tanggal_pinjam'] ?? date('Y-m-d'));
    $jatuh_tempo    = trim($_POST['tgl_jatuh_tempo'] ?? $_POST['jatuh_tempo'] ?? date('Y-m-d', strtotime('+7 days')));

    if ($anggota_id === '' || $buku_id === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota dan Buku wajib dipilih!'];
        header('Location: tambah.php');
        exit;
    }

    try {
        // Query disesuaikan dengan kolom database (tanggal_pinjam & jatuh_tempo)
        $stmt = $pdo->prepare("INSERT INTO peminjaman (anggota_id, buku_id, tanggal_pinjam, jatuh_tempo, status) VALUES (:anggota_id, :buku_id, :tanggal_pinjam, :jatuh_tempo, 'Dipinjam')");
        $stmt->execute([
            ':anggota_id'     => $anggota_id,
            ':buku_id'        => $buku_id,
            ':tanggal_pinjam' => $tanggal_pinjam,
            ':jatuh_tempo'    => $jatuh_tempo
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Transaksi peminjaman berhasil ditambahkan!'];
        header('Location: riwayat.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses peminjaman: ' . $e->getMessage()];
        header('Location: tambah.php');
        exit;
    }
} else {
    header('Location: riwayat.php');
    exit;
}