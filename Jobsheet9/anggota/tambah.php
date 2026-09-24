<?php

$page_title = 'Tambah Anggota';

require_once '../includes/header.php';

?>

<section class="page-header">

    <div>
        <span class="section-label">Data Perpustakaan</span>

        <h1>Tambah Anggota</h1>

        <p>
            Tambahkan data anggota baru ke dalam database.
        </p>
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
            <label for="nama">Nama Anggota</label>

            <input
                type="text"
                id="nama"
                name="nama"
                placeholder="Masukkan nama anggota"
                required>
        </div>

        <div class="form-group">
            <label for="no_anggota">Nomor Anggota</label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                placeholder="Contoh: AGT001"
                required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>

            <textarea
                id="alamat"
                name="alamat"
                rows="4"
                placeholder="Masukkan alamat anggota"></textarea>
        </div>

        <div class="form-group">
            <label for="no_hp">Nomor HP</label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                placeholder="Contoh: 081234567890">
        </div>

        <div class="form-actions">

            <a href="list.php" class="btn btn-secondary">
                Batal
            </a>

            <button
                type="submit"
                class="btn btn-primary">
                Simpan Anggota
            </button>

        </div>

    </form>

</section>

<?php require_once '../includes/footer.php'; ?>