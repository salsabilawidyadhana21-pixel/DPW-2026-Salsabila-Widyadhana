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

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');

if ($nama === '' || $no_anggota === '') {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Nama dan No Anggota wajib diisi.'];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :no_hp)");
    $stmt->execute([
        'nama' => $nama,
        'no_anggota' => $no_anggota,
        'alamat' => $alamat,
        'no_hp' => $no_hp
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan!'];
    header('Location: list.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menambah anggota: ' . $e->getMessage()];
    header('Location: tambah.php');
    exit;
}