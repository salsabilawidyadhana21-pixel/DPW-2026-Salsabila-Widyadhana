<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? $_SESSION['nama'] ?? 'Pengguna';
$baseUrl = '/Jobsheet12';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini | <?php echo htmlspecialchars($page_title ?? 'Sistem Perpustakaan', ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="<?php echo $baseUrl; ?>/assets/style.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; min-height: 100vh; display: flex; flex-direction: column; }
        
        .navbar { background-color: #1d5b8a; color: white; padding: 0.8rem 2rem; display: flex; justify-content: space-between; align-items: center; position: relative; }
        .navbar .brand { font-size: 1.4rem; font-weight: bold; color: white; text-decoration: none; }
        
        .nav-menu { display: flex; align-items: center; gap: 1.2rem; list-style: none; }
        .nav-menu a { color: white; text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: opacity 0.2s; }
        .nav-menu a:hover { opacity: 0.8; }
        
        .user-info { font-size: 0.9rem; color: #e0e0e0; margin-left: 1rem; }
        .user-info strong { color: white; }

        .btn-auth { background-color: #ffffff; color: #1d5b8a !important; padding: 0.35rem 0.8rem; border-radius: 4px; font-weight: bold !important; }
        .btn-auth:hover { background-color: #f0f0f0; }

        /* Hamburger Toggle untuk Mobile */
        .hamburger { display: none; background: none; border: none; color: white; font-size: 1.5rem; cursor: pointer; }

        @media (max-width: 768px) {
            .hamburger { display: block; }
            .nav-menu { display: none; flex-direction: column; position: absolute; top: 100%; left: 0; right: 0; background-color: #1d5b8a; padding: 1rem; gap: 0.8rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000; }
            .nav-menu.active { display: flex; }
        }

        main { flex: 1; max-width: 1100px; width: 100%; margin: 2rem auto; padding: 0 1rem; }
    </style>
</head>
<body>

<header class="navbar">
    <a href="<?php echo $baseUrl; ?>/index.php" class="brand">SIMPUS-Mini</a>

    <button class="hamburger" id="hamburgerBtn" aria-label="Toggle Navigation">&#9776;</button>

    <ul class="nav-menu" id="navMenu">
        <li><a href="<?php echo $baseUrl; ?>/index.php">Beranda</a></li>
        <li><a href="<?php echo $baseUrl; ?>/buku/list.php">Daftar Buku</a></li>
        <li><a href="<?php echo $baseUrl; ?>/anggota/list.php">Daftar Anggota</a></li>
        <li><a href="<?php echo $baseUrl; ?>/peminjaman/tambah.php">Pinjam Buku</a></li>
        <li><a href="<?php echo $baseUrl; ?>/peminjaman/riwayat.php">Riwayat Peminjaman</a></li>

        <?php if ($isLoggedIn): ?>
            <li class="user-info">Halo, <strong><?php echo htmlspecialchars(strtoupper($username), ENT_QUOTES, 'UTF-8'); ?></strong></li>
            <li><a href="<?php echo $baseUrl; ?>/auth/logout.php" class="btn-auth">Logout</a></li>
        <?php else: ?>
            <li><a href="<?php echo $baseUrl; ?>/auth/login.php" class="btn-auth">Login</a></li>
        <?php endif; ?>
    </ul>
</header>

<script>
    document.getElementById('hamburgerBtn').addEventListener('click', function() {
        document.getElementById('navMenu').classList.toggle('active');
    });
</script>

<main>