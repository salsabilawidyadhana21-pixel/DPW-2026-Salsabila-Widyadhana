<?php

$page_title = 'Edit Anggota';

require_once '../includes/header.php';
require_once '../includes/koneksi.php';

// Mengambil ID anggota dari URL
$id = $_GET['id'] ?? '';

// Pastikan ID berupa angka
if (!ctype_digit($id)) {
    header('Location: list.php');
    exit;
}

// Mengambil data anggota berdasarkan ID
$stmt = $pdo->prepare(
    "SELECT *
     FROM anggota
     WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);

$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan
if (!$anggota) {
    header('Location: list.php');
    exit;
}

?>

<section class="page-header">

    <div>
        <span class="section-label">Data Perpustakaan</span>

        <h1>Edit Anggota</h1>

        <p>
            Ubah data anggota yang sudah tersimpan.
        </p>
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
            value="<?= htmlspecialchars($anggota['id']) ?>">

        <div class="form-group">
            <label for="nama">Nama Anggota</label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="<?= htmlspecialchars($anggota['nama']) ?>"
                placeholder="Masukkan nama anggota"
                required>
        </div>

        <div class="form-group">
            <label for="no_anggota">Nomor Anggota</label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                value="<?= htmlspecialchars($anggota['no_anggota']) ?>"
                placeholder="Contoh: AGT001"
                required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>

            <textarea
                id="alamat"
                name="alamat"
                rows="4"
                placeholder="Masukkan alamat anggota"><?= htmlspecialchars($anggota['alamat'] ?? '') ?></textarea>
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP</label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                value="<?= htmlspecialchars($anggota['no_hp'] ?? '') ?>"
                placeholder="Contoh: 081234567890">
        </div>

        <div class="form-actions">

            <a href="list.php" class="btn btn-secondary">
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary">
                Simpan Perubahan
            </button>

        </div>

    </form>

</section>

<?php require_once '../includes/footer.php'; ?>