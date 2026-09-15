<?php

require_once '../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];

if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}

if ($noAnggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}

if (!empty($errors)) {

    session_start();

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: tambah.php');
    exit;
}

$sql = "INSERT INTO anggota
        (nama, no_anggota, alamat, no_hp)
        VALUES
        (:nama, :no_anggota, :alamat, :no_hp)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':nama' => $nama,
    ':no_anggota' => $noAnggota,
    ':alamat' => $alamat,
    ':no_hp' => $noHp
]);

session_start();

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil ditambahkan ke database.'
];

header('Location: list.php');
exit;