<?php

// Memastikan user sudah login
require_once '../includes/auth.php';


// =====================================================
// Hanya admin dan petugas yang boleh mengedit buku
// =====================================================

require_role(['admin', 'petugas']);


// Memanggil koneksi database
require_once '../includes/koneksi.php';


// =====================================================
// 1. Mengambil ID dari URL
// =====================================================

$id = $_GET['id'] ?? '';


// Jika ID tidak tersedia
if ($id === '') {

    header('Location: list.php');
    exit;
}


// =====================================================
// 2. Mengambil data buku berdasarkan ID
// =====================================================

$stmt = $pdo->prepare(
    "SELECT *
     FROM buku
     WHERE id = :id"
);

$stmt->execute([
    ':id' => $id
]);

$buku = $stmt->fetch(PDO::FETCH_ASSOC);


// Jika data buku tidak ditemukan
if (!$buku) {

    die('Data buku tidak ditemukan.');

}


// Judul halaman
$page_title = 'Edit Buku';


// Memanggil header
require_once '../includes/header.php';

?>


<section class="page-header">

    <div>

        <span class="section-label">
            Data Buku
        </span>

        <h1>
            Edit Buku
        </h1>

        <p>
            Ubah data buku yang sudah tersimpan.
        </p>

    </div>


    <!-- Kembali ke daftar buku -->
    <a
        href="list.php"
        class="btn btn-secondary">

        Kembali

    </a>

</section>


<section class="content-card form-card">

    <!--
        Form mengirim data ke
        proses_edit.php menggunakan method POST
    -->

    <form
        action="proses_edit.php"
        method="POST">


        <!--
            ID disimpan sebagai hidden input
            agar proses_edit.php mengetahui
            data mana yang akan diubah
        -->

        <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars($buku['id']) ?>">


        <!-- Input judul -->
        <div class="form-group">

            <label for="judul">
                Judul
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                value="<?= htmlspecialchars($buku['judul']) ?>"
                required>

        </div>


        <!-- Input pengarang -->
        <div class="form-group">

            <label for="pengarang">
                Pengarang
            </label>

            <input
                type="text"
                id="pengarang"
                name="pengarang"
                value="<?= htmlspecialchars($buku['pengarang']) ?>"
                required>

        </div>


        <!-- Input tahun -->
        <div class="form-group">

            <label for="tahun">
                Tahun
            </label>

            <input
                type="number"
                id="tahun"
                name="tahun"
                value="<?= htmlspecialchars($buku['tahun']) ?>"
                required>

        </div>


        <!-- Input ISBN -->
        <div class="form-group">

            <label for="isbn">
                ISBN
            </label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>">

        </div>


        <!-- Input stok -->
        <div class="form-group">

            <label for="stok">
                Stok
            </label>

            <input
                type="number"
                id="stok"
                name="stok"
                value="<?= htmlspecialchars($buku['stok']) ?>"
                min="0"
                required>

        </div>


        <!-- Input kategori -->
        <div class="form-group">

            <label for="kategori">
                Kategori
            </label>

            <input
                type="text"
                id="kategori"
                name="kategori"
                value="<?= htmlspecialchars($buku['kategori'] ?? '') ?>">

        </div>


        <!-- Tombol form -->
        <div class="form-actions">

            <a
                href="list.php"
                class="btn btn-secondary">

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


<?php

// Memanggil footer
require_once '../includes/footer.php';

?>