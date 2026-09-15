<?php
session_start();

// Menentukan lokasi root Jobsheet 8
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);
$rootDir = dirname($scriptDir);

$base = '';

if ($scriptDir !== $rootDir) {
    $depth = substr_count(trim(str_replace($rootDir, '', $scriptDir), '/'), '/');
    $base = str_repeat('../', $depth + 1);
}

$page_title = $page_title ?? 'Beranda';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMPUS-Mini | <?= htmlspecialchars($page_title) ?></title>

    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">
</head>

<body>

<header class="site-header">
    <div class="container">
        <h1>SIMPUS-Mini</h1>

        <button
            type="button"
            id="nav-toggle-btn"
            class="nav-toggle-label"
            aria-label="Buka menu">
            ☰
        </button>

        <nav id="main-nav">
            <a href="<?= $base ?>index.php">Beranda</a>
            <a href="<?= $base ?>buku/list.php">Daftar Buku</a>
            <a href="<?= $base ?>buku/tambah.php">Tambah Buku</a>
            <a href="<?= $base ?>anggota/list.php">Daftar Anggota</a>
            <a href="<?= $base ?>anggota/tambah.php">Tambah Anggota</a>
        </nav>
    </div>
</header>

<main class="container">