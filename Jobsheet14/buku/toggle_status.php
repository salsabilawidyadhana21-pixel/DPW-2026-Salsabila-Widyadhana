<?php
// Output buffering untuk mencegah error "headers already sent"
ob_start();

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Proteksi Auth: Pastikan user sudah login
if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'
    ];
    header('Location: ../auth/login.php');
    exit;
}

require_once __DIR__ . '/../includes/koneksi.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // Ambil status buku saat ini
        $stmt = $pdo->prepare("SELECT status FROM buku WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $buku = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($buku) {
            // Normalisasi & balikkan status
            $currentStatus = strtolower(trim($buku['status'] ?? 'aktif'));
            $newStatus = ($currentStatus === 'aktif') ? 'Nonaktif' : 'Aktif';

            // Update status di database
            $updateStmt = $pdo->prepare("UPDATE buku SET status = :status WHERE id = :id");
            $updateStmt->execute([
                ':status' => $newStatus,
                ':id'     => $id
            ]);

            $_SESSION['flash'] = [
                'type' => 'success',
                'pesan' => "Status buku berhasil diubah menjadi {$newStatus}."
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
            'pesan' => 'Gagal mengubah status buku: ' . $e->getMessage()
        ];
    }
}

// Redirect kembali ke list.php
header('Location: list.php');
exit;