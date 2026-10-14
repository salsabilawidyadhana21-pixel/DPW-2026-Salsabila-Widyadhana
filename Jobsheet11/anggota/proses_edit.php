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
    // Validasi CSRF Token
    if (!empty($_POST['csrf_token']) && !empty($_SESSION['csrf_token'])) {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Token keamanan tidak valid.'];
            header('Location: list.php');
            exit;
        }
    }

    $id         = (int)($_POST['id'] ?? 0);
    $no_anggota = trim($_POST['no_anggota'] ?? $_POST['nim'] ?? '');
    $nama       = trim($_POST['nama'] ?? '');
    $alamat     = trim($_POST['alamat'] ?? '');
    $no_hp      = trim($_POST['no_hp'] ?? '');

    if ($id <= 0 || $nama === '' || $no_anggota === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID, Nama, dan No Anggota wajib diisi!'];
        header('Location: edit.php?id=' . $id);
        exit;
    }

    try {
        // Query disesuaikan dengan skema PostgreSQL: no_anggota, nama, alamat, no_hp
        $stmt = $pdo->prepare("UPDATE anggota SET no_anggota = :no_anggota, nama = :nama, alamat = :alamat, no_hp = :no_hp WHERE id = :id");
        $stmt->execute([
            ':no_anggota' => $no_anggota,
            ':nama'       => $nama,
            ':alamat'     => $alamat,
            ':no_hp'      => $no_hp,
            ':id'         => $id
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil diperbarui!'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui anggota: ' . $e->getMessage()];
        header('Location: edit.php?id=' . $id);
        exit;
    }
} else {
    header('Location: list.php');
    exit;
}