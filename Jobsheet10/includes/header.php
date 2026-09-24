<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$page_title = $page_title ?? 'SIMPUS-Mini';

$base_path = '/Jobsheet10';

$is_logged_in = isset($_SESSION['user_id']);

$current_name = $_SESSION['nama'] ?? '';

$current_role = $_SESSION['role'] ?? '';

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($page_title) ?> - SIMPUS-Mini
    </title>

    <link
        rel="stylesheet"
        href="<?= $base_path ?>/assets/css/style.css">

</head>

<body>

<header>

    <h1>

        <a
            href="<?= $base_path ?>/index.php"
            style="color: #fff; text-decoration: none;">

            SIMPUS-Mini

        </a>

    </h1>


    <button
        type="button"
        class="nav-toggle-label"
        id="nav-toggle"
        aria-label="Buka menu">

        ☰

    </button>


    <nav id="main-nav">

        <?php if ($is_logged_in): ?>

            <!-- Nama user yang sedang login -->

            <span style="color: #fff;">

                Halo,
                <strong>
                    <?= htmlspecialchars($current_name) ?>
                </strong>

            </span>


            <!-- Menu utama setelah login -->

            <a href="<?= $base_path ?>/index.php">
                Dashboard
            </a>


            <a href="<?= $base_path ?>/buku/list.php">
                Buku
            </a>


            <a href="<?= $base_path ?>/anggota/list.php">
                Anggota
            </a>


            <!-- Logout -->

            <a href="<?= $base_path ?>/auth/logout.php">
                Logout
            </a>


        <?php else: ?>

            <!-- Menu sebelum login -->

            <a href="<?= $base_path ?>/auth/login.php">
                Login
            </a>


            <a href="<?= $base_path ?>/auth/register.php">
                Register
            </a>

        <?php endif; ?>

    </nav>

</header>

<main>