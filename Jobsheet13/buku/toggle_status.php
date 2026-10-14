<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'
    ];
    header('Location: ../auth/login.php');
    exit;
}
?>

<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
require_once __DIR__ . '/../includes/koneksi.php';

// Terima request baik dari POST (Form CSRF) maupun GET (Link biasa)
$id = (int)($_POST['id'] ?? $_GET['id'] ?? 0);

if ($id > 0) {
    try {
        // 1. Ambil status buku saat ini dari database
        $stmt = $pdo->prepare("SELECT status FROM buku WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $buku = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($buku) {
            // 2. Balik statusnya (Jika Nonaktif jadi Aktif, dan sebaliknya)
            $status_sekarang = $buku['status'] ?? 'Aktif';
            $status_baru = ($status_sekarang === 'Nonaktif') ? 'Aktif' : 'Nonaktif';
            
            // 3. Update ke database
            $update = $pdo->prepare("UPDATE buku SET status = :status WHERE id = :id");
            $update->execute([
                'status' => $status_baru,
                'id' => $id
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'pesan' => "Status buku berhasil diubah menjadi {$status_baru}."
            ];
        } else {
            $_SESSION['flash'] = [
                'type' => 'error',
                'pesan' => 'Data buku tidak ditemukan.'
            ];
        }
    } catch (PDOException $e) {
        $_SESSION['flash'] = [
            'type' => 'error',
            'pesan' => 'Gagal mengubah status: ' . $e->getMessage()
        ];
    }
} else {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'ID buku tidak valid.'
    ];
}

header('Location: list.php');
exit;