<?php
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>

<style>
    .card-box {
        background: #ffffff;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.06);
        max-width: 600px;
    }
    .card-box h2 {
        color: #1d5b8a;
        margin-bottom: 1.5rem;
        font-size: 1.5rem;
    }
    .form-group {
        margin-bottom: 1.2rem;
    }
    .form-group label {
        display: block;
        font-weight: 600;
        margin-bottom: 0.4rem;
        color: #333;
        font-size: 0.9rem;
    }
    .form-control {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 0.9rem;
        box-sizing: border-box;
    }
    .btn-primary {
        background-color: #1d5b8a;
        color: #ffffff;
        padding: 0.6rem 1.2rem;
        border: none;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .btn-primary:hover {
        background-color: #16466b;
    }
    .btn-link {
        display: inline-block;
        margin-top: 1rem;
        color: #1d5b8a;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-link:hover {
        text-decoration: underline;
    }
</style>

<div class="card-box">
    <h2>Tambah Anggota Baru</h2>

    <?php if ($flash): ?>
        <div style="padding: 0.75rem 1rem; border-radius: 4px; margin-bottom: 1rem; background-color: <?php echo ($flash['type'] ?? '') === 'error' ? '#f8d7da' : '#d4edda'; ?>; color: <?php echo ($flash['type'] ?? '') === 'error' ? '#721c24' : '#155724'; ?>;">
            <?php echo htmlspecialchars($flash['pesan'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <form method="post" action="proses_tambah.php">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-control" placeholder="Contoh: Aisyah Putri" required>
        </div>

        <div class="form-group">
            <label for="no_anggota">No. Anggota / NIM</label>
            <input type="text" id="no_anggota" name="no_anggota" class="form-control" placeholder="Contoh: AGT012 atau 202324" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <input type="text" id="alamat" name="alamat" class="form-control" placeholder="Contoh: Jl. Semanggi No. 10, Malang" required>
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP / WhatsApp</label>
            <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="Contoh: 081234567890" required>
        </div>

        <button type="submit" class="btn-primary">Simpan Anggota</button>
    </form>

    <a href="list.php" class="btn-link">&laquo; Kembali ke Daftar Anggota</a>
</div>

<?php include __DIR__ . '/../includes/footer.php'; ?>