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
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_tambah.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

        <p>
            <label for="judul">Judul Buku</label><br>
            <input type="text" id="judul" name="judul" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <p>
            <label for="pengarang">Pengarang</label><br>
            <input type="text" id="pengarang" name="pengarang" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <p>
            <label for="tahun">Tahun Terbit</label><br>
            <input type="number" id="tahun" name="tahun" required min="1000" max="2099" style="width: 100%; max-width: 200px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <p>
            <label for="stok">Stok</label><br>
            <input type="number" id="stok" name="stok" required min="0" style="width: 100%; max-width: 200px; padding: 0.5rem; margin-top: 0.25rem;">
        </p>
        <button type="submit" style="padding: 0.5rem 1.25rem; cursor: pointer; background-color: #1d5b8a; color: white; border: none; border-radius: 4px;">Simpan Buku</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Kembali ke Daftar Buku</a></p>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>