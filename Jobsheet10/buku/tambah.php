<?php

// Memastikan user sudah login
require_once '../includes/auth.php';


// =====================================================
// Hanya admin dan petugas yang boleh mengakses
// halaman tambah buku
// =====================================================

require_role(['admin', 'petugas']);


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
        proses_tambah.php menggunakan method POST
    -->

    <form
        action="proses_tambah.php"
        method="POST">


        <!-- Input judul -->
        <div class="form-group">

            <label for="judul">
                Judul
            </label>

            <input
                type="text"
                id="judul"
                name="judul"
                placeholder="Masukkan judul buku"
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
                placeholder="Masukkan nama pengarang"
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
                placeholder="Masukkan tahun terbit"
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
                placeholder="Masukkan ISBN">

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
                value="0"
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
                placeholder="Masukkan kategori buku">

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

                Simpan Buku

            </button>

        </div>

    </form>

</section>


<?php

// Memanggil footer
require_once '../includes/footer.php';

?>