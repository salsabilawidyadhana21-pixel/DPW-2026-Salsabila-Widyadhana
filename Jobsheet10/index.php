<?php

// Memastikan user sudah login
require_once 'includes/auth.php';


// Judul halaman
$page_title = 'Dashboard';


// Memanggil header website
require_once 'includes/header.php';

?>


<section class="page-header">

    <div>

        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Dashboard
        </h1>

        <p>
            Selamat datang di SIMPUS-Mini.
        </p>

    </div>

</section>


<section class="content-card">

    <h2>
        Halo, <?= htmlspecialchars($_SESSION['nama']) ?>!
    </h2>

    <p>
        Anda berhasil login ke sistem.
    </p>

    <p>
        Username:
        <strong>
            <?= htmlspecialchars($_SESSION['username']) ?>
        </strong>
    </p>

    <p>
        Role:
        <strong>
            <?= htmlspecialchars($_SESSION['role']) ?>
        </strong>
    </p>

</section>


<section class="content-card">

    <h2>
        Menu Sistem
    </h2>

    <div class="form-actions">

        <!-- Menu data buku -->
        <a
            href="buku/list.php"
            class="btn btn-primary">

            Data Buku

        </a>


        <!-- Menu data anggota -->
        <a
            href="anggota/list.php"
            class="btn btn-primary">

            Data Anggota

        </a>


        <!-- Tombol logout -->
        <a
            href="auth/logout.php"
            class="btn btn-secondary">

            Logout

        </a>

    </div>

</section>


<?php

// Memanggil footer
require_once 'includes/footer.php';

?>