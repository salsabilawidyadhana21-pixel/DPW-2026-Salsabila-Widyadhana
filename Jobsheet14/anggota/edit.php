<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user']) && !isset($_SESSION['user_id'])) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => 'Silakan login terlebih dahulu untuk mengakses halaman ini.'
    ];
    header('Location: ../auth/login.php');
    exit;
}
?>

<?php
require_once __DIR__ . '/../includes/auth.php';
$page_title = "Edit Anggota";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

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

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<section>
    <h2>Edit Anggota</h2>

    <form method="post" action="proses_edit.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">

        <p><label>Nama Anggota:</label><br><input type="text" name="nama" value="<?php echo htmlspecialchars($anggota['nama'], ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>No Anggota:</label><br><input type="text" name="no_anggota" value="<?php echo htmlspecialchars($anggota['no_anggota'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>
        <p><label>Alamat:</label><br><textarea name="alamat" style="width: 100%; max-width: 400px; padding: 0.5rem;"><?php echo htmlspecialchars($anggota['alamat'] ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea></p>
        <p><label>No HP:</label><br><input type="text" name="no_hp" value="<?php echo htmlspecialchars($anggota['no_hp'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" style="width: 100%; max-width: 400px; padding: 0.5rem;"></p>

        <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Perubahan</button>
    </form>
    <p style="margin-top: 1rem;"><a href="list.php">&laquo; Batal</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>