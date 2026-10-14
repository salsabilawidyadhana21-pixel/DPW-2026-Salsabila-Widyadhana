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

verify_csrf_token($_POST['csrf_token'] ?? null);

$id = (int) ($_POST['id'] ?? 0);
$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

if ($id <= 0 || $nama === '' || $no_anggota === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Data tidak valid.'];
    header('Location: list.php');
    exit;
}

try {
    $stmt = $pdo->prepare("UPDATE anggota SET nama = :nama, no_anggota = :no_anggota, alamat = :alamat, no_hp = :no_hp WHERE id = :id");
    $stmt->execute([
        'id' => $id,
        'nama' => $nama,
        'no_anggota' => $no_anggota,
        'alamat' => $alamat,
        'no_hp' => $no_hp
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil diperbarui!'];
    header('Location: list.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal memperbarui anggota: ' . $e->getMessage()];
    header('Location: list.php');
    exit;
}