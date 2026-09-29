<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENAMBAH ANGGOTA
// =====================================================

require_role(['admin', 'petugas']);


// =====================================================
// CSRF PROTECTION
// =====================================================

require_once '../includes/csrf.php';


// Judul halaman
$page_title = 'Tambah Anggota';


// Memanggil header
require_once '../includes/header.php';

?>


<section class="page-header">

    <div>

        <span class="section-label">
            Data Anggota
        </span>

        <h1>
            Tambah Anggota
        </h1>

        <p>
            Tambahkan data anggota baru.
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
         FORM TAMBAH ANGGOTA
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
                placeholder="Masukkan nama anggota"
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
                placeholder="Masukkan nomor anggota"
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
                placeholder="Masukkan alamat anggota"
                maxlength="500"></textarea>

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
                placeholder="Masukkan nomor HP"
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

                Simpan

            </button>

        </div>

    </form>

</section>


<?php

// Memanggil footer
require_once '../includes/footer.php';

?>