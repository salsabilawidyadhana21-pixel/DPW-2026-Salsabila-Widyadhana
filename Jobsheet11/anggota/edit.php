<?php
ob_start();

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/koneksi.php';

$page_title = "Edit Anggota";

$id = (int) ($_GET['id'] ?? 0);
if ($id <= 0) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM anggota WHERE id = :id");
$stmt->execute(['id' => $id]);
$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anggota) {
    header('Location: list.php');
    exit;
}

include __DIR__ . '/../includes/header.php';
?>

<section>
    <h2>Edit Anggota</h2>

    <form method="post" action="proses_edit.php">
        <input type="hidden" name="id" value="<?php echo (int)$anggota['id']; ?>">

        <p><label>NIM / No. Anggota:</label><br><input type="text" name="nim" value="<?php echo htmlspecialchars($anggota['nim'] ?? $anggota['no_anggota'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Nama Lengkap:</label><br><input type="text" name="nama" value="<?php echo htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Alamat / HP:</label><br><input type="text" name="alamat" value="<?php echo htmlspecialchars($anggota['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>

        <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Batal</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>