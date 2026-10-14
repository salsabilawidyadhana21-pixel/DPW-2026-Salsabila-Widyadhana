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
    // Validasi CSRF Token (opsional tapi diselaraskan dengan edit.php)
    if (!empty($_POST['csrf_token']) && !empty($_SESSION['csrf_token'])) {
        if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Token keamanan tidak valid.'];
            header('Location: list.php');
            exit;
        }
    }

    $id        = (int)($_POST['id'] ?? 0);
    $judul     = trim($_POST['judul'] ?? '');
    $pengarang = trim($_POST['pengarang'] ?? '');
    $tahun     = trim($_POST['tahun'] ?? '');
    $isbn      = trim($_POST['isbn'] ?? '');
    $stok      = (int)($_POST['stok'] ?? 0);

    if ($id <= 0 || $judul === '' || $pengarang === '') {
        $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'ID tidak valid atau data wajib belum diisi!'];
        header('Location: edit.php?id=' . $id);
        exit;
    }

    try {
        // Coba update lengkap beserta ISBN
        $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok WHERE id = :id");
        $stmt->execute([
            ':judul'     => $judul,
            ':pengarang' => $pengarang,
            ':tahun'     => $tahun,
            ':isbn'      => $isbn,
            ':stok'      => $stok,
            ':id'        => $id
        ]);

        $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui!'];
        header('Location: list.php');
        exit;
    } catch (PDOException $e) {
        // Fallback jika tabel buku di DB tidak memiliki kolom isbn
        try {
            $stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, stok = :stok WHERE id = :id");
            $stmt->execute([
                ':judul'     => $judul,
                ':pengarang' => $pengarang,
                ':tahun'     => $tahun,
                ':stok'      => $stok,
                ':id'        => $id
            ]);

            $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui!'];
            header('Location: list.php');
            exit;
        } catch (PDOException $ex) {
            $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui buku: ' . $ex->getMessage()];
            header('Location: edit.php?id=' . $id);
            exit;
        }
    }
} else {
    header('Location: list.php');
    exit;
}