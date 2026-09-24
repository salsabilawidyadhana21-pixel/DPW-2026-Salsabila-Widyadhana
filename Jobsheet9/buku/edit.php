<?php

$page_title = 'Edit Buku';

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

// Mengambil ID buku dari URL
$id = $_GET['id'] ?? '';

// Pastikan ID berupa angka
if (!ctype_digit($id)) {
    header('Location: list.php');
    exit;
}

// Mengambil data buku berdasarkan ID
$stmt = $pdo->prepare(
    "SELECT *
     FROM buku
     WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);

$buku = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan
if (!$buku) {
    header('Location: list.php');
    exit;
}

?>

<section class="page-header">
    <div>
        <span class="section-label">Data Perpustakaan</span>
        <h1>Edit Buku</h1>
        <p>Ubah data buku yang sudah tersimpan.</p>
    </div>

    <a href="list.php" class="btn btn-secondary">
        ← Kembali
    </a>
</section>

<section class="content-card form-card">

    <form
        action="proses_edit.php"
        method="POST"
        id="form-tambah">

        <!-- ID digunakan untuk menentukan data yang akan diubah -->
        <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars($buku['id']) ?>">

        <div class="form-group">
            <label for="judul">Judul Buku</label>

            <input
                type="text"
                id="judul"
                name="judul"
                value="<?= htmlspecialchars($buku['judul']) ?>"
                placeholder="Masukkan judul buku"
                required>
        </div>

        <div class="form-group">
            <label for="pengarang">Pengarang</label>

            <input
                type="text"
                id="pengarang"
                name="pengarang"
                value="<?= htmlspecialchars($buku['pengarang']) ?>"
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
                    value="<?= htmlspecialchars($buku['tahun']) ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="stok">Stok</label>

                <input
                    type="number"
                    id="stok"
                    name="stok"
                    min="0"
                    value="<?= htmlspecialchars($buku['stok']) ?>"
                    required>
            </div>

        </div>

        <div class="form-group">
            <label for="isbn">ISBN</label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>"
                placeholder="Masukkan ISBN">
        </div>

        <div class="form-group">
            <label for="kategori">Kategori</label>

            <input
                type="text"
                id="kategori"
                name="kategori"
                value="<?= htmlspecialchars($buku['kategori'] ?? '') ?>"
                placeholder="Contoh: Teknologi">
        </div>

        <div class="form-actions">

            <a href="list.php" class="btn btn-secondary">
                Batal
            </a>

            <button type="submit" class="btn btn-primary">
                Simpan Perubahan
            </button>

        </div>

    </form>

</section>

<?php require_once '../includes/footer.php'; ?>