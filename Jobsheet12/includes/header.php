<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user']) || isset($_SESSION['user_id']);
$username   = $_SESSION['user']['username'] ?? $_SESSION['username'] ?? 'User';
$role       = $_SESSION['user']['role'] ?? $_SESSION['role'] ?? 'petugas';

// Menentukan base path folder jobsheet secara otomatis
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$parts = explode('/', trim($scriptName, '/'));
$basePath = '/' . ($parts[0] ?? '');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'SIMPUS-Mini'; ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #f4f6f9; color: #333; }
        .navbar { background-color: #1d5b8a; color: #ffffff; padding: 0.8rem 2rem; display: flex; justify-content: space-between; align-items: center; position: relative; z-index: 100; }
        .navbar-brand { font-size: 1.4rem; font-weight: bold; color: #fff; text-decoration: none; }
        .nav-links { list-style: none; display: flex; gap: 1.2rem; align-items: center; }
        .nav-links a { color: #ffffff; text-decoration: none; font-size: 0.95rem; font-weight: 500; transition: opacity 0.2s; }
        .nav-links a:hover { opacity: 0.8; }
        .btn-auth { background-color: #ffffff; color: #1d5b8a !important; padding: 0.4rem 1rem; border-radius: 4px; font-weight: bold !important; text-decoration: none; }
        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1rem; }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="<?php echo $basePath; ?>/index.php" class="navbar-brand">SIMPUS-Mini</a>
    <ul class="nav-links">
        <!-- Tampil untuk SEMUA Pengguna (Sebelum & Sesudah Login) -->
        <li><a href="<?php echo $basePath; ?>/index.php">Beranda</a></li>
        <li><a href="<?php echo $basePath; ?>/buku/list.php">Daftar Buku</a></li>

        <?php if ($isLoggedIn): ?>
            <!-- Hanya tampil jika SUDAH LOGIN -->
            <li><a href="<?php echo $basePath; ?>/anggota/list.php">Daftar Anggota</a></li>
            <li><a href="<?php echo $basePath; ?>/peminjaman/tambah.php">Pinjam Buku</a></li>
            <li><a href="<?php echo $basePath; ?>/peminjaman/riwayat.php">Riwayat Peminjaman</a></li>
            <li style="margin-left: 0.8rem; font-size: 0.88rem;">Halo, <strong><?php echo htmlspecialchars($username); ?></strong> (<?php echo htmlspecialchars($role); ?>)</li>
            <li><a href="<?php echo $basePath; ?>/auth/logout.php" class="btn-auth">Logout</a></li>
        <?php else: ?>
            <!-- Tampil jika BELUM LOGIN -->
            <li><a href="<?php echo $basePath; ?>/auth/login.php" class="btn-auth">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<div class="container">