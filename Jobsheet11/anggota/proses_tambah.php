<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

verify_csrf_token($_POST['csrf_token'] ?? null);

$nama      = trim(filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$noAnggota = trim(filter_var($_POST['no_anggota'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$alamat    = trim(filter_var($_POST['alamat'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$noHp      = trim(filter_var($_POST['no_hp'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

$errors = [];
if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}
if ($noAnggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare("INSERT INTO anggota (nama, no_anggota, alamat, no_hp) VALUES (:nama, :no_anggota, :alamat, :no_hp)");
$stmt->execute([
    'nama'       => $nama,
    'no_anggota' => $noAnggota,
    'alamat'     => $alamat,
    'no_hp'      => $noHp
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;
?>