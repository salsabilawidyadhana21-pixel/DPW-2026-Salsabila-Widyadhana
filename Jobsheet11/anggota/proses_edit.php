<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';
require_once __DIR__ . '/../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: list.php');
    exit;
}

verify_csrf_token($_POST['csrf_token'] ?? null);

$id        = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
$nama      = trim(filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$noAnggota = trim(filter_var($_POST['no_anggota'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$alamat    = trim(filter_var($_POST['alamat'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$noHp      = trim(filter_var($_POST['no_hp'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($nama === '') $errors[] = "Nama wajib diisi.";
if ($noAnggota === '') $errors[] = "No. Anggota wajib diisi.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . $id);
    exit;
}

$stmt = $pdo->prepare("UPDATE anggota SET nama = :nama, no_anggota = :no_anggota, alamat = :alamat, no_hp = :no_hp WHERE id = :id");
$stmt->execute([
    'nama'       => $nama,
    'no_anggota' => $noAnggota,
    'alamat'     => $alamat,
    'no_hp'      => $noHp,
    'id'         => $id
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data anggota berhasil diperbarui.'];
header('Location: list.php');
exit;
?>