<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);

// Menyesuaikan base path dengan yang ada di footer.php
$base_path = '/Jobsheet12';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIMPUS-Mini<?php echo isset($page_title) ? ' | ' . htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8') : ''; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/assets/css/style.css">
</head>
<body>
    <header>
        <h1>SIMPUS-Mini</h1>
        <button id="nav-toggle-btn" class="nav-toggle-label" aria-label="Toggle Navigation">&#9776;</button>
        <?php if ($sudahLogin): ?>
        <nav>
            <ul>
                <li><a href="<?php echo $base_path; ?>/index.php">Beranda</a></li>
                <li><a href="<?php echo $base_path; ?>/buku/list.php">Daftar Buku</a></li>
                <li><a href="<?php echo $base_path; ?>/anggota/list.php">Daftar Anggota</a></li>
                <li><a href="<?php echo $base_path; ?>/peminjaman/tambah.php">Pinjam Buku</a></li>
                <li><a href="<?php echo $base_path; ?>/peminjaman/riwayat.php">Riwayat Peminjaman</a></li>
            </ul>
        </nav>
        <div class="user-info">
            <span>Halo, <strong><?php echo htmlspecialchars($_SESSION['nama'] ?? 'User', ENT_QUOTES, 'UTF-8'); ?></strong></span>
            <a href="<?php echo $base_path; ?>/auth/logout.php" class="btn-logout" style="margin-left:10px; color:#fff; text-decoration:underline;">Logout</a>
        </div>
        <?php endif; ?>
    </header>
    <main class="container">