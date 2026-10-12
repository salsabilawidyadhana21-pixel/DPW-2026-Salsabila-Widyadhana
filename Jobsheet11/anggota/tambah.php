<?php
require_once __DIR__ . '/../includes/auth.php';
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section>
    <h2>Tambah Anggota Baru</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_tambah.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

        <p>
            <label for="nim">NIM / No Anggota</label><br>
            <input type="text" id="nim" name="nim" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" id="nama" name="nama" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <p>
            <label for="email">Email / Alamat</label><br>
            <input type="text" id="email" name="email" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <button type="submit" style="padding: 0.5rem 1.25rem; cursor: pointer; background-color: #1d5b8a; color: white; border: none; border-radius: 4px;">Simpan Anggota</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Kembali ke Daftar Anggota</a></p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>