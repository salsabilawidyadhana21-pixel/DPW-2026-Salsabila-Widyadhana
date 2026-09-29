<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENGEDIT ANGGOTA
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


// Judul halaman
$page_title = 'Edit Anggota';


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
// 2. MENGAMBIL DATA ANGGOTA
// Menggunakan prepared statement
// =====================================================

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


// Memanggil header
require_once '../includes/header.php';

?>


<section class="page-header">

    <div>

        <span class="section-label">
            Data Anggota
        </span>

        <h1>
            Edit Anggota
        </h1>

        <p>
            Ubah data anggota perpustakaan.
        </p>

    </div>


    <!-- Tombol kembali -->
    <a
        href="list.php"
        class="btn btn-secondary">

        Kembali

    </a>

</section>


<section class="content-card form-card">


    <!-- =================================================
         FORM EDIT ANGGOTA
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
             ID ANGGOTA
             ================================================= -->

        <input
            type="hidden"
            name="id"
            value="<?= (int) $anggota['id'] ?>">


        <!-- =================================================
             INPUT NAMA
             ================================================= -->

        <div class="form-group">

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="<?= htmlspecialchars($anggota['nama']) ?>"
                maxlength="100"
                required>

        </div>


        <!-- =================================================
             INPUT NOMOR ANGGOTA
             ================================================= -->

        <div class="form-group">

            <label for="no_anggota">
                No. Anggota
            </label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                value="<?= htmlspecialchars($anggota['no_anggota']) ?>"
                maxlength="30"
                required>

        </div>


        <!-- =================================================
             INPUT ALAMAT
             ================================================= -->

        <div class="form-group">

            <label for="alamat">
                Alamat
            </label>

            <textarea
                id="alamat"
                name="alamat"
                maxlength="500"><?= htmlspecialchars($anggota['alamat'] ?? '') ?></textarea>

        </div>


        <!-- =================================================
             INPUT NOMOR HP
             ================================================= -->

        <div class="form-group">

            <label for="no_hp">
                No. HP
            </label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                value="<?= htmlspecialchars($anggota['no_hp'] ?? '') ?>"
                maxlength="20">

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