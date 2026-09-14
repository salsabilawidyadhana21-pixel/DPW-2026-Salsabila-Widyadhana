<?php

session_start();

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');

$errors = [];


/*
 * VALIDASI SERVER-SIDE
 */

if ($nama === '') {
    $errors[] = "Nama wajib diisi.";
}

if ($noAnggota === '') {
    $errors[] = "No. Anggota wajib diisi.";
}


/*
 * JIKA ADA ERROR
 */

if (!empty($errors)) {

    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode(' ', $errors)
    ];

    header('Location: tambah.php');
    exit;
}


/*
 * MEMBUAT SESSION ANGGOTA
 */

if (!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}


/*
 * MENYIMPAN DATA
 */

$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp
];


/*
 * PESAN BERHASIL
 */

$_SESSION['flash'] = [
    'type' => 'success',
    'pesan' => 'Anggota berhasil ditambahkan.'
];


/*
 * KEMBALI KE LIST
 */

header('Location: list.php');
exit;