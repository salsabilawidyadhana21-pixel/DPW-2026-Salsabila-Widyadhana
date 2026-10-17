<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user']) || isset($_SESSION['user_id']);
$username   = $_SESSION['user']['username'] ?? $_SESSION['username'] ?? 'User';
$role       = $_SESSION['user']['role'] ?? $_SESSION['role'] ?? 'petugas';

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
        
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: space-between;
            width: 30px;
            height: 21px;
            background: transparent;
            border: none;
            cursor: pointer;
            padding: 0;
            z-index: 101;
        }
        .hamburger span {
            width: 100%;
            height: 3px;
            background-color: #ffffff;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .container { max-width: 1100px; margin: 2rem auto; padding: 0 1rem; }

        @media (max-width: 768px) {
            .navbar { padding: 0.8rem 1rem; }
            .hamburger { display: flex; }
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                width: 100%;
                background-color: #1d5b8a;
                padding: 1rem 0;
                gap: 1rem;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .nav-links.active { display: flex !important; }
            .nav-links li { width: 100%; text-align: center; }
            .btn-auth { display: inline-block; margin-top: 0.5rem; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="<?php echo $basePath; ?>/index.php" class="navbar-brand">SIMPUS-Mini</a>
    
    <button type="button" class="hamburger" id="hamburger-btn" onclick="toggleMenu()" aria-label="Toggle Navigation">
        <span></span>
        <span></span>
        <span></span>
    </button>

    <ul class="nav-links" id="nav-menu">
        <li><a href="<?php echo $basePath; ?>/index.php">Beranda</a></li>
        <li><a href="<?php echo $basePath; ?>/buku/list.php">Daftar Buku</a></li>

        <?php if ($isLoggedIn): ?>
            <li><a href="<?php echo $basePath; ?>/anggota/list.php">Daftar Anggota</a></li>
            <li><a href="<?php echo $basePath; ?>/peminjaman/tambah.php">Pinjam Buku</a></li>
            <li><a href="<?php echo $basePath; ?>/peminjaman/riwayat.php">Riwayat Peminjaman</a></li>
            <li style="font-size: 0.88rem; color: #fff;">Halo, <strong><?php echo htmlspecialchars($username); ?></strong> (<?php echo htmlspecialchars($role); ?>)</li>
            <li><a href="<?php echo $basePath; ?>/auth/logout.php" class="btn-auth">Logout</a></li>
        <?php else: ?>
            <li><a href="<?php echo $basePath; ?>/auth/login.php" class="btn-auth">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>

<script>
function toggleMenu() {
    var menu = document.getElementById('nav-menu');
    if (menu) {
        menu.classList.toggle('active');
    }
}
</script>

<div class="container">
<main>