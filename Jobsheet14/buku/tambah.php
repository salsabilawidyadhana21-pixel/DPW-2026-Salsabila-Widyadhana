<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENAMBAH BUKU
// =====================================================

require_role(['admin', 'petugas']);


// =====================================================
// MEMANGGIL CSRF PROTECTION
// =====================================================

require_once '../includes/csrf.php';


// Judul halaman
$page_title = 'Tambah Buku';


// Memanggil header
require_once '../includes/header.php';

?>


<section class="page-header">

    <div>

        <span class="section-label">
            Data Buku
        </span>

        <h1>
            Tambah Buku
        </h1>

        <p>
            Tambahkan data buku baru ke dalam sistem.
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
         FORM TAMBAH BUKU
         ================================================= -->

    <form
        action="proses_tambah.php"
        method="POST">


        <!-- =================================================
             TOKEN CSRF
             ================================================= -->

        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrf_token()) ?>">


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
                placeholder="Masukkan judul buku"
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
                placeholder="Masukkan nama pengarang"
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
                placeholder="Masukkan tahun terbit"
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
                placeholder="Masukkan ISBN"
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
                value="0"
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
                placeholder="Masukkan kategori buku"
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

                Simpan Buku

            </button>

        </div>

    </form>

</section>


<?php

// Memanggil footer
require_once '../includes/footer.php';

?>