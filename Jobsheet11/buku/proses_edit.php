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
$judul     = trim(filter_var($_POST['judul'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$pengarang = trim(filter_var($_POST['pengarang'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$tahun     = filter_var($_POST['tahun'] ?? '', FILTER_VALIDATE_INT);
$isbn      = trim(filter_var($_POST['isbn'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$stok       = filter_var($_POST['stok'] ?? '', FILTER_VALIDATE_INT);
$kategori  = trim(filter_var($_POST['kategori'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($judul === '') $errors[] = "Judul wajib diisi.";
if ($pengarang === '') $errors[] = "Pengarang wajib diisi.";
if ($tahun === false || $tahun < 1900 || $tahun > (int)date('Y') + 1) $errors[] = "Tahun tidak valid.";
if ($stok === false || $stok < 0) $errors[] = "Stok harus berupa angka non-negatif.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . $id);
    exit;
}

$stmt = $pdo->prepare("UPDATE buku SET judul = :judul, pengarang = :pengarang, tahun = :tahun, isbn = :isbn, stok = :stok, kategori = :kategori WHERE id = :id");
$stmt->execute([
    'judul'     => $judul,
    'pengarang' => $pengarang,
    'tahun'     => $tahun,
    'isbn'      => $isbn,
    'stok'      => $stok,
    'kategori'  => $kategori,
    'id'        => $id
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Data buku berhasil diperbarui.'];
header('Location: list.php');
exit;
?>