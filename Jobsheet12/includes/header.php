<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);

// Hitung path relatif secara otomatis
$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button id="nav-toggle-btn" class="nav-toggle-label" aria-label="Toggle Navigation">&#9776;</button>
        <?php if ($sudahLogin): ?>
        <nav>
            <ul>
                <li><a href="<?php echo $base; ?>index.php">Beranda</a></li>
                <li><a href="<?php echo $base; ?>buku/list.php">Daftar Buku</a></li>
                <li><a href="<?php echo $base; ?>anggota/list.php">Daftar Anggota</a></li>
                <li><a href="<?php echo $base; ?>peminjaman/tambah.php">Pinjam Buku</a></li>
                <li><a href="<?php echo $base; ?>peminjaman/riwayat.php">Riwayat Peminjaman</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <span>Halo, <strong><?php echo htmlspecialchars($_SESSION['nama'] ?? 'User', ENT_QUOTES, 'UTF-8'); ?></strong></span>
            <a href="<?php echo $base; ?>auth/logout.php" class="btn-logout" style="margin-left:10px; color:#fff; text-decoration:underline;">Logout</a>
        </div>
        <?php endif; ?>
    </header>
    <main class="container">