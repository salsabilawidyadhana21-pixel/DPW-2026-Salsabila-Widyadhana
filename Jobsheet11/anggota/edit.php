<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/csrf.php';
$page_title = "Edit Anggota";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = filter_var($_GET['id'] ?? null, FILTER_VALIDATE_INT);
if (!$id) {
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
?>
<section>
    <h2>Edit Anggota</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php echo htmlspecialchars($flash['pesan'], ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form id="form-tambah" method="post" action="proses_edit.php">
        <input type="hidden" name="csrf_token" value="<?php echo generate_csrf_token(); ?>">
        <input type="hidden" name="id" value="<?php echo (int)$anggota['id']; ?>">

        <p>
            <label for="nama">Nama Lengkap</label><br>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="no_anggota">No. Anggota</label><br>
            <input type="text" id="no_anggota" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota'], ENT_QUOTES, 'UTF-8'); ?>" required>
        </p>
        <p>
            <label for="alamat">Alamat</label><br>
            <textarea id="alamat" name="alamat" style="width: 100%; max-width: 400px; padding: 0.55rem;"><?php echo htmlspecialchars($anggota['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
        </p>
        <p>
            <label for="no_hp">No. HP</label><br>
            <input type="text" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
        </p>
        <button type="submit">Simpan Perubahan</button>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>