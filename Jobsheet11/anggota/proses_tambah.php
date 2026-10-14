<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $no_anggota = trim($_POST['no_anggota'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if ($nama === '' || $no_anggota === '') {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Nama dan No. Anggota wajib diisi!'
        ];
        header('Location: tambah.php');
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :no_hp)");
        $stmt->execute([
            ':nama'       => $nama,
            ':no_anggota' => $no_anggota,
            ':alamat'     => $alamat,
            ':no_hp'      => $no_hp
        ]);

        $_SESSION['flash'] = [
            'type' => 'success',
            'pesan' => 'Anggota berhasil ditambahkan!'
        ];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Gagal menambahkan anggota: ' . $e->getMessage()
        ];
        header('Location: tambah.php');
        exit;
    }
} else {
    header('Location: list.php');
    exit;
}