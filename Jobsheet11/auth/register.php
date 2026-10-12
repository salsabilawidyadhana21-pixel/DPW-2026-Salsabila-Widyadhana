<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Registrasi Petugas";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <h2>Registrasi Petugas</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_register.php">
        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" id="nama" name="nama" required>
        </p>
        <p>
            <label for="username">Username</label><br>
            <input type="text" id="username" name="username" required autocomplete="off">
        </p>
        <p>
            <label for="password">Password (Min. 6 Karakter)</label><br>
            <input type="password" id="password" name="password" required>
        </p>
        <p>
            <label for="role">Role</label><br>
            <select id="role" name="role">
                <option value="petugas">Petugas</option>
                <option value="admin">Admin</option>
            </select>
        </p>
        <button type="submit">Daftar</button>
    </form>
    <p style="margin-top: 1rem;">Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>