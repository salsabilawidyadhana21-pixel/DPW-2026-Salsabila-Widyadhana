<?php
ob_start();

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';

$page_title = "Edit Buku";

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
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

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Edit Buku</h2>

    <form method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo (int)$buku['id']; ?>">

        <p><label>Judul Buku:</label><br><input type="text" name="judul" value="<?php echo htmlspecialchars($buku['judul'], ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Pengarang:</label><br><input type="text" name="pengarang" value="<?php echo htmlspecialchars($buku['pengarang'], ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Tahun Terbit:</label><br><input type="number" name="tahun" value="<?php echo htmlspecialchars($buku['tahun'], ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Stok:</label><br><input type="number" name="stok" value="<?php echo htmlspecialchars($buku['stok'], ENT_QUOTES, 'UTF-8'); ?>" min="0" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>

        <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Batal</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>