<?php

$page_title = "Tambah Buku";

require_once '../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

?>

<section>
    <h2>Tambah Buku</h2>

    <?php if ($flash): ?>
        <div class="flash <?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </div>
    <?php endif; ?>

    <form action="proses_tambah.php" method="POST">

        <div class="form-group">
            <label for="judul">Judul Buku</label>
            <input
                type="text"
                id="judul"
                name="judul"
                required
            >
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang</label>
            <input
                type="text"
                id="pengarang"
                name="pengarang"
                required
            >
        </div>

        <div class="form-group">
            <label for="tahun">Tahun</label>
            <input
                type="number"
                id="tahun"
                name="tahun"
                min="1900"
                max="2026"
                required
            >
        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>
            <input
                type="text"
                id="isbn"
                name="isbn"
            >
        </div>

        <div class="form-group">
            <label for="stok">Stok</label>
            <input
                type="number"
                id="stok"
                name="stok"
                min="0"
                required
            >
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>

            <select id="kategori" name="kategori">
                <option value="fiksi">Fiksi</option>
                <option value="non-fiksi">Non-Fiksi</option>
                <option value="referensi">Referensi</option>
            </select>
        </div>

        <button type="submit" class="btn">
            Simpan
        </button>

    </form>
</section>

<?php require_once '../includes/footer.php'; ?>