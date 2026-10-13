<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$page_title = "Registrasi Petugas";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section class="login-card">
    <h2>Registrasi Petugas</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_register.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        
        <p>
            <label for="nama">Nama Lengkap:</label><br>
            <input type="text" name="nama" id="nama" required style="width: 100%; padding: 0.5rem; margin-top: 0.25rem;">
        </p>

        <p style="margin-top: 1rem;">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required style="width: 100%; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        
        <p style="margin-top: 1rem;">
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required style="width: 100%; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        
        <p style="margin-top: 1.25rem;">
            <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Daftar Akun</button>
        </p>
    </form>
    <p style="margin-top: 1rem;">Sudah punya akun? <a href="login.php">Login di sini</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>