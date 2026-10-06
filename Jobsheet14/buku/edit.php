<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENGEDIT BUKU
// =====================================================

require_role(['admin', 'petugas']);


// =====================================================
// KONEKSI DATABASE
// =====================================================

require_once '../includes/koneksi.php';


// =====================================================
// CSRF PROTECTION
// =====================================================

require_once '../includes/csrf.php';


// =====================================================
// 1. MENGAMBIL ID DARI URL
// =====================================================

$id = filter_input(
    INPUT_GET,
    'id',
    FILTER_VALIDATE_INT
);


// Jika ID tidak valid
if ($id === false || $id === null || $id <= 0) {

    header('Location: list.php');
    exit;
}


// =====================================================
// 2. MENGAMBIL DATA BUKU
// Menggunakan prepared statement
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


// Jika data tidak ditemukan
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


    <!-- =================================================
         FORM EDIT BUKU
         ================================================= -->

    <form
        action="proses_edit.php"
        method="POST">


        <!-- =================================================
             TOKEN CSRF
             ================================================= -->

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrf_token()) ?>">


        <!-- =================================================
             ID BUKU
             ================================================= -->

        <input
            type="hidden"
            name="id"
            value="<?= (int) $buku['id'] ?>">


        <!-- =================================================
             INPUT JUDUL
             ================================================= -->

        <div class="form-group">

            <label for="judul">
                Judul
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                value="<?= htmlspecialchars($buku['judul']) ?>"
                maxlength="150"
                required>

        </div>


        <!-- =================================================
             INPUT PENGARANG
             ================================================= -->

        <div class="form-group">

            <label for="pengarang">
                Pengarang
            </label>

            <input
                type="text"
                id="pengarang"
                name="pengarang"
                value="<?= htmlspecialchars($buku['pengarang']) ?>"
                maxlength="100"
                required>

        </div>


        <!-- =================================================
             INPUT TAHUN
             ================================================= -->

        <div class="form-group">

            <label for="tahun">
                Tahun
            </label>

            <input
                type="number"
                id="tahun"
                name="tahun"
                value="<?= (int) $buku['tahun'] ?>"
                required>

        </div>


        <!-- =================================================
             INPUT ISBN
             ================================================= -->

        <div class="form-group">

            <label for="isbn">
                ISBN
            </label>

            <input
                type="text"
                id="isbn"
                name="isbn"
                value="<?= htmlspecialchars($buku['isbn'] ?? '') ?>"
                maxlength="30">

        </div>


        <!-- =================================================
             INPUT STOK
             ================================================= -->

        <div class="form-group">

            <label for="stok">
                Stok
            </label>

            <input
                type="number"
                id="stok"
                name="stok"
                value="<?= (int) $buku['stok'] ?>"
                min="0"
                required>

        </div>


        <!-- =================================================
             INPUT KATEGORI
             ================================================= -->

        <div class="form-group">

            <label for="kategori">
                Kategori
            </label>

            <input
                type="text"
                id="kategori"
                name="kategori"
                value="<?= htmlspecialchars($buku['kategori'] ?? '') ?>"
                maxlength="30">

        </div>


        <!-- =================================================
             TOMBOL FORM
             ================================================= -->

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