<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
$page_title = "Edit Buku";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id' => $id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Buku</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_edit.php">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <input type="hidden" name="id" value="<?php echo (int)$buku['id']; ?>">

        <p>
            <label for="judul">Judul</label><br>
            <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($buku['judul'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="pengarang">Pengarang</label><br>
            <input type="text" id="pengarang" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="tahun">Tahun</label><br>
            <input type="number" id="tahun" name="tahun" value="<?php echo htmlspecialchars($buku['tahun'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="isbn">ISBN</label><br>
            <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($buku['isbn'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </p>
        <p>
            <label for="stok">Stok</label><br>
            <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($buku['stok'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="kategori">Kategori</label><br>
            <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($buku['kategori'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </p>
        <button type="submit">Simpan Perubahan</button>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>