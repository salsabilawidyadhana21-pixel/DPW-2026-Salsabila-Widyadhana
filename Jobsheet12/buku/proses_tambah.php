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

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun = (int) ($_POST['tahun'] ?? 0);
$isbn = trim($_POST['isbn'] ?? '');
$stok = (int) ($_POST['stok'] ?? 0);

if ($judul === '' || $pengarang === '' || $tahun <= 0) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Judul, Pengarang, dan Tahun wajib diisi secara valid.'];
    header('Location: tambah.php');
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO buku (judul, pengarang, tahun, isbn, stok, status) VALUES (:judul, :pengarang, :tahun, :isbn, :stok, 'Aktif')");
    $stmt->execute([
        'judul' => $judul,
        'pengarang' => $pengarang,
        'tahun' => $tahun,
        'isbn' => $isbn,
        'stok' => $stok
    ]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan!'];
    header('Location: list.php');
    exit;
} catch (Exception $e) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => 'Gagal menambah buku: ' . $e->getMessage()];
    header('Location: tambah.php');
    exit;
}