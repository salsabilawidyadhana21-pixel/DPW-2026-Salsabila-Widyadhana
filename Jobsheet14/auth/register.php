<?php

$page_title = 'Register';

// Mengambil header website
require_once '../includes/header.php';

?>

<section class="page-header">

    <div>

        <span class="section-label">
            Autentikasi
        </span>

        <h1>
            Register
        </h1>

        <p>
            Buat akun baru untuk mengakses SIMPUS-Mini.
        </p>

    </div>

    <!-- Tombol menuju halaman login -->
    <a
        href="login.php"
        class="btn btn-secondary">

        Login

    </a>

</section>


<section class="content-card form-card">

    <!--
        Form register mengirim data ke
        proses_register.php menggunakan POST
    -->

    <form
        action="proses_register.php"
        method="POST"
        id="form-register">


        <!-- Input nama -->
        <div class="form-group">

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                placeholder="Masukkan nama"
                required>

        </div>


        <!-- Input username -->
        <div class="form-group">

            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                placeholder="Masukkan username"
                required>

        </div>


        <!-- Input password -->
        <div class="form-group">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Masukkan password"
                required>

        </div>


        <!-- Konfirmasi password -->
        <div class="form-group">

            <label for="password_confirm">
                Konfirmasi Password
            </label>

            <input
                type="password"
                id="password_confirm"
                name="password_confirm"
                placeholder="Ulangi password"
                required>

        </div>


        <!-- Tombol form -->
        <div class="form-actions">

            <a
                href="../index.php"
                class="btn btn-secondary">

                Batal

            </a>

            <button
                type="submit"
                class="btn btn-primary">

                Register

            </button>

        </div>

    </form>

</section>


<?php

// Mengambil footer website
require_once '../includes/footer.php';

?>