<?php

$page_title = 'Tambah Buku';

require_once '../includes/header.php';

?>

<section class="page-header">
    <div>
        <span class="section-label">Data Perpustakaan</span>
        <h1>Tambah Buku</h1>
        <p>Tambahkan data buku baru ke dalam database.</p>
    </div>

    <a href="list.php" class="btn btn-secondary">
        ← Kembali
    </a>
</section>

<section class="content-card form-card">

    <form
        action="proses_tambah.php"
        method="POST"
        id="form-tambah">

        <div class="form-group">
            <label for="judul">Judul Buku</label>

            <input
                type="text"
                id="judul"
                name="judul"
                placeholder="Masukkan judul buku"
                required>
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang</label>

            <input
                type="text"
                id="pengarang"
                name="pengarang"
                placeholder="Masukkan nama pengarang"
                required>
        </div>

        <div class="form-row">

            <div class="form-group">
                <label for="tahun">Tahun Terbit</label>

                <input
                    type="number"
                    id="tahun"
                    name="tahun"
                    min="1900"
                    max="2026"
                    placeholder="Contoh: 2024"
                    required>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>

                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    placeholder="Jumlah stok"
                    required>
            </div>

        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                placeholder="Masukkan ISBN">
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>

            <input
                type="text"
                id="kategori"
                name="kategori"
                placeholder="Contoh: Teknologi">
        </div>

        <div class="form-actions">

            <a href="list.php" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Buku
            </button>

        </div>

    </form>

</section>

<?php require_once '../includes/footer.php'; ?>