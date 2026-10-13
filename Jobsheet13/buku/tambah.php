<?php
require_once __DIR__ . '/../includes/auth.php';
$page_title = "Tambah Buku";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section>
    <h2>Tambah Buku Baru</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: #f8d7da; color: #721c24;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_tambah.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

        <p><label>Judul Buku:</label><br><input type="text" name="judul" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Pengarang:</label><br><input type="text" name="pengarang" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Tahun Terbit:</label><br><input type="number" name="tahun" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>ISBN:</label><br><input type="text" name="isbn" style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Stok:</label><br><input type="number" name="stok" value="1" min="0" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>

        <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Buku</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Kembali ke Daftar Buku</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>