<?php

session_start();

$projectRoot = '/Jobsheet9';
$base = $projectRoot . '/';

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        SIMPUS-Mini
        <?= isset($page_title) ? ' | ' . $page_title : '' ?>
    </title>

    <link rel="stylesheet" href="<?= $base ?>assets/css/style.css">

</head>

<body>

<header class="site-header">

    <div class="header-container">

        <div class="brand">
            <strong>SIMPUS-Mini</strong>
        </div>

        <nav>

            <a href="<?= $base ?>index.php">
                Beranda
            </a>

            <a href="<?= $base ?>buku/list.php">
                Daftar Buku
            </a>

            <a href="<?= $base ?>buku/tambah.php">
                Tambah Buku
            </a>

            <a href="<?= $base ?>anggota/list.php">
                Daftar Anggota
            </a>

            <a href="<?= $base ?>anggota/tambah.php">
                Tambah Anggota
            </a>

        </nav>

    </div>

</header>

<main class="container">