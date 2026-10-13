<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id']);
$username = $_SESSION['username'] ?? $_SESSION['nama'] ?? 'Pengguna';
$baseUrl = '/Jobsheet14';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUS-Mini | <?php echo htmlspecialchars($page_title ?? 'Sistem Perpustakaan', ENT_QUOTES, 'UTF-8'); ?></title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; color: #333; min-height: 100vh; display: flex; flex-direction: column; }
        
        .navbar { 
            background-color: #1d5b8a; 
            color: white; 
            padding: 0.8rem 2rem; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            position: relative;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .navbar .brand { 
            font-size: 1.4rem; 
            font-weight: bold; 
            color: white; 
            text-decoration: none; 
            z-index: 1001;
        }
        
        .nav-menu { 
            display: flex; 
            align-items: center; 
            gap: 1.2rem; 
            list-style: none; 
            margin: 0;
            padding: 0;
        }
        .nav-menu li { display: inline-block; }
        .nav-menu a { 
            color: white; 
            text-decoration: none; 
            font-size: 0.95rem; 
            font-weight: 500; 
            padding: 0.4rem 0.6rem;
            border-radius: 4px;
            transition: background-color 0.2s, opacity 0.2s; 
            display: inline-block;
        }
        .nav-menu a:hover { 
            background-color: rgba(255, 255, 255, 0.15); 
        }
        
        .user-info { 
            font-size: 0.9rem; 
            color: #e0e0e0; 
            margin-left: 0.5rem; 
        }
        .user-info strong { color: white; }

        .btn-auth { 
            background-color: #ffffff !important; 
            color: #1d5b8a !important; 
            padding: 0.35rem 0.9rem !important; 
            border-radius: 4px; 
            font-weight: bold !important; 
        }
        .btn-auth:hover { 
            background-color: #f0f0f0 !important; 
            opacity: 0.9;
        }

        /* Hamburger Toggle untuk Layar Kecil / HP */
        .hamburger { 
            display: none; 
            background: none; 
            border: none; 
            color: white; 
            font-size: 1.8rem; 
            cursor: pointer; 
            z-index: 1001;
            padding: 0 0.5rem;
        }

        @media (max-width: 850px) {
            .hamburger { display: block; }
            .nav-menu { 
                display: none; 
                flex-direction: column; 
                position: absolute; 
                top: 100%; 
                left: 0; 
                right: 0; 
                background-color: #1d5b8a; 
                padding: 1rem 2rem; 
                gap: 0.8rem; 
                box-shadow: 0 4px 8px rgba(0,0,0,0.2); 
                align-items: flex-start;
            }
            .nav-menu.active { display: flex; }
            .nav-menu li { width: 100%; }
            .nav-menu a { display: block; width: 100%; padding: 0.6rem 0; }
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
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('hamburgerBtn');
        const menu = document.getElementById('navMenu');
        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('active');
            });
        }
    });
</script>

<main>