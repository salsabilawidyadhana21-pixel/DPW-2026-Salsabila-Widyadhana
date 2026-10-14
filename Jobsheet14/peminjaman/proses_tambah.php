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

    if ($anggota_id === '' || $buku_id === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Anggota dan Buku wajib dipilih!'];
        header('Location: tambah.php');
        exit;
    }

    try {
        // Coba Insert dengan kolom standard (tanggal_pinjam & status)
        $stmt = $pdo->prepare("INSERT INTO peminjaman (anggota_id, buku_id, tanggal_pinjam, status) VALUES (:anggota_id, :buku_id, :tanggal_pinjam, 'Dipinjam')");
        $stmt->execute([
            ':anggota_id'     => $anggota_id,
            ':buku_id'        => $buku_id,
            ':tanggal_pinjam' => $tanggal_pinjam
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Transaksi peminjaman berhasil ditambahkan!'];
        header('Location: riwayat.php');
        exit;
    } catch (PDOException $e) {
        // Jika ternyata nama kolom tanggalnya adalah tgl_pinjam (bukan tanggal_pinjam)
        try {
            $stmt = $pdo->prepare("INSERT INTO peminjaman (anggota_id, buku_id, tgl_pinjam, status) VALUES (:anggota_id, :buku_id, :tgl_pinjam, 'Dipinjam')");
            $stmt->execute([
                ':anggota_id' => $anggota_id,
                ':buku_id'    => $buku_id,
                ':tgl_pinjam' => $tanggal_pinjam
            ]);

            $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Transaksi peminjaman berhasil ditambahkan!'];
            header('Location: riwayat.php');
            exit;
        } catch (PDOException $ex) {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memproses peminjaman: ' . $ex->getMessage()];
            header('Location: tambah.php');
            exit;
        }
    }
} else {
    header('Location: riwayat.php');
    exit;
}