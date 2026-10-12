<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

// Token CSRF Sederhana
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$page_title = "Login";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Login Petugas</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_login.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

        <p style="margin-bottom: 1rem;">
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required autocomplete="off" style="width: 100%; max-width: 350px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>

        <p style="margin-bottom: 1rem;">
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required style="width: 100%; max-width: 350px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>

        <button type="submit" style="padding: 0.5rem 1.25rem; cursor: pointer; background-color: #1d5b8a; color: white; border: none; border-radius: 4px;">Login</button>
    </form>

    <p style="margin-top: 1.5rem;">Belum punya akun? <a href="register.php">Registrasi di sini</a>.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>