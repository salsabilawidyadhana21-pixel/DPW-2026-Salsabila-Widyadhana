<?php

// HALAMAN LOGIN

$page_title = 'Login';

// Memanggil header website
require_once '../includes/header.php';

?>

<section class="page-header">

    <div>

        <span class="section-label">
            Autentikasi
        </span>

        <h1>
            Login
        </h1>

        <p>
            Login untuk mengakses sistem SIMPUS-Mini.
        </p>

    </div>

    <!-- Tombol menuju halaman register -->
    <a
        href="register.php"
        class="btn btn-secondary">

        Register

    </a>

</section>


<section class="content-card form-card">

    <!--
        Form login mengirim data ke
        proses_login.php menggunakan method POST
    -->

    <form
        action="proses_login.php"
        method="POST"
        id="form-login">


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

                Login

            </button>

        </div>

    </form>

</section>


<?php

// Memanggil footer website
require_once '../includes/footer.php';

?>