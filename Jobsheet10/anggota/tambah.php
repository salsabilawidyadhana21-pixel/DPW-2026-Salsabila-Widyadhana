<?php

require_once '../includes/auth.php';
require_role(['admin', 'petugas']);

$page_title = 'Tambah Anggota';

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

    <a
        href="list.php"
        class="btn btn-secondary">

        Kembali

    </a>

</section>


<section class="content-card form-card">

    <form
        action="proses_tambah.php"
        method="POST">

        <div class="form-group">

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                placeholder="Masukkan nama anggota"
                required>

        </div>


        <div class="form-group">

            <label for="no_anggota">
                No. Anggota
            </label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                placeholder="Masukkan nomor anggota"
                required>

        </div>


        <div class="form-group">

            <label for="alamat">
                Alamat
            </label>

            <textarea
                id="alamat"
                name="alamat"
                placeholder="Masukkan alamat anggota"></textarea>

        </div>


        <div class="form-group">

            <label for="no_hp">
                No. HP
            </label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                placeholder="Masukkan nomor HP">

        </div>


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

require_once '../includes/footer.php';

?>