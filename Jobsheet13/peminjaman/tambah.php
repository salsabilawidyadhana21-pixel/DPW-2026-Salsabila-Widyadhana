<?php
//require_once __DIR__ . '/../includes/auth.php';//
$page_title = "Tambah Peminjaman";
include __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Ambil data Anggota dari database
$stmtAnggota = $pdo->query("SELECT id, nama, no_anggota FROM anggota ORDER BY nama ASC");
$daftarAnggota = $stmtAnggota->fetchAll(PDO::FETCH_ASSOC);

// Ambil data Buku yang stoknya > 0 (Jobsheet 12 Langkah 2)
$stmtBuku = $pdo->query("SELECT id, judul, stok FROM buku WHERE stok > 0 AND (status IS NULL OR status = 'Aktif') ORDER BY judul ASC");
$daftarBuku = $stmtBuku->fetchAll(PDO::FETCH_ASSOC);
?>

<section>
    <h2>Form Peminjaman Buku</h2>

    <?php if ($flash): ?>
        <p class="flash flash-<?php echo htmlspecialchars($flash['type'] ?? 'error', ENT_QUOTES, 'UTF-8'); ?>" style="padding: 0.75rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </p>
    <?php endif; ?>

    <form method="post" action="proses_tambah.php">
        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">

        <p>
            <label for="anggota_id">Pilih Anggota:</label><br>
            <select name="anggota_id" id="anggota_id" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
                <option value="">-- Pilih Anggota --</option>
                <?php foreach ($daftarAnggota as $a): ?>
                    <option value="<?php echo $a['id']; ?>">
                        <?php echo htmlspecialchars($a['nama'] . ' (' . ($a['no_anggota'] ?? 'NIM/No ID') . ')', ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <label for="buku_id">Pilih Buku (Hanya Stok > 0):</label><br>
            <select name="buku_id" id="buku_id" required style="width: 100%; max-width: 400px; padding: 0.5rem; margin-top: 0.25rem;">
                <option value="">-- Pilih Buku --</option>
                <?php foreach ($daftarBuku as $b): ?>
                    <option value="<?php echo $b['id']; ?>">
                        <?php echo htmlspecialchars($b['judul'] . ' (Stok: ' . $b['stok'] . ')', ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>

        <button type="submit" style="padding: 0.5rem 1.25rem; background-color: #1d5b8a; color: white; border: none; border-radius: 4px; cursor: pointer;">Simpan Peminjaman</button>
    </form>
    <p style="margin-top: 1rem;"><a href="riwayat.php">&laquo; Lihat Riwayat Peminjaman</a></p>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>