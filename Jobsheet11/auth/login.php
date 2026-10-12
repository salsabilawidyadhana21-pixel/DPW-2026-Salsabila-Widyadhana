<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/csrf.php';

$page_title = "Login";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Login Petugas</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_login.php">
        <!-- Menggunakan generate_csrf_token() yang sesuai dengan includes/csrf.php -->
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">

        <p>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required autocomplete="off">
        </p>
        <p>
            <label for="password">Password</label><br>
            <input type="password" id="password" name="password" required>
        </p>
        <button type="submit">Login</button>
    </form>
    <p style="margin-top: 1rem;">Belum punya akun? <a href="register.php">Registrasi di sini</a>.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>