<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// ADMIN DAN PETUGAS BOLEH MENGAKSES DATA ANGGOTA
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
$page_title = 'Data Anggota';


// Memanggil header
require_once '../includes/header.php';


// =====================================================
// SEARCH
// =====================================================

$keyword = trim($_GET['keyword'] ?? '');


// Jika ada keyword pencarian
if ($keyword !== '') {

    $sql = "
        SELECT *
        FROM anggota
        WHERE nama ILIKE :keyword
           OR no_anggota ILIKE :keyword
           OR alamat ILIKE :keyword
           OR no_hp ILIKE :keyword
        ORDER BY id DESC
    ";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':keyword' => '%' . $keyword . '%'
    ]);


// Jika tidak ada pencarian
} else {

    $sql = "
        SELECT *
        FROM anggota
        ORDER BY id DESC
    ";

    // Query aman karena tidak menggunakan
    // input dari user
    $stmt = $pdo->query($sql);
}


// Mengambil semua data anggota
$anggota = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<section class="page-header">

    <div>

        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Data Anggota
        </h1>

        <p>
            Kelola data anggota perpustakaan.
        </p>

    </div>


    <!-- Tombol tambah anggota -->
    <a
        href="tambah.php"
        class="btn btn-primary">

        + Tambah Anggota

    </a>

</section>


<section class="content-card">


    <!-- =================================================
         FORM SEARCH
         ================================================= -->

    <form
        method="GET"
        class="search-box">


        <input
            type="text"
            name="keyword"
            placeholder="Cari anggota..."
            value="<?= htmlspecialchars($keyword) ?>"
            maxlength="100">


        <button
            type="submit"
            class="btn btn-primary">

            Cari

        </button>


        <?php if ($keyword !== ''): ?>

            <a
                href="list.php"
                class="btn btn-secondary">

                Reset

            </a>

        <?php endif; ?>


    </form>


    <!-- =================================================
         TABEL DATA ANGGOTA
         ================================================= -->

    <div class="table-responsive">

        <table>

            <thead>

                <tr>

                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Anggota</th>
                    <th>Alamat</th>
                    <th>No. HP</th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>


                <?php if (count($anggota) > 0): ?>


                    <?php foreach ($anggota as $index => $data): ?>


                        <tr>


                            <!-- Nomor -->
                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <!-- Nama -->
                            <td>
                                <?= htmlspecialchars($data['nama']) ?>
                            </td>


                            <!-- Nomor anggota -->
                            <td>
                                <?= htmlspecialchars($data['no_anggota']) ?>
                            </td>


                            <!-- Alamat -->
                            <td>
                                <?= htmlspecialchars($data['alamat'] ?? '-') ?>
                            </td>


                            <!-- Nomor HP -->
                            <td>
                                <?= htmlspecialchars($data['no_hp'] ?? '-') ?>
                            </td>


                            <!-- Aksi -->
                            <td>


                                <!-- =========================
                                     TOMBOL EDIT
                                     ========================= -->

                                <a
                                    href="edit.php?id=<?= (int) $data['id'] ?>"
                                    class="btn btn-edit">

                                    Edit

                                </a>


                                <?php if (($_SESSION['role'] ?? '') === 'admin'): ?>


                                    <!-- =========================
                                         FORM HAPUS
                                         ========================= -->

                                    <form
                                        action="hapus.php"
                                        method="POST"
                                        style="display: inline;">


                                        <!-- ID anggota -->
                                        <input
                                            type="hidden"
                                            name="id"
                                            value="<?= (int) $data['id'] ?>">


                                        <!-- Token CSRF -->
                                        <input
                                            type="hidden"
                                            name="csrf_token"
                                            value="<?= htmlspecialchars(csrf_token()) ?>">


                                        <!-- Tombol hapus -->
                                        <button
                                            type="submit"
                                            class="btn btn-hapus"
                                            onclick="return confirm('Yakin ingin menghapus data anggota ini?');">

                                            Hapus

                                        </button>


                                    </form>


                                <?php endif; ?>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="6"
                            style="text-align: center;">

                            Data anggota tidak ditemukan.

                        </td>

                    </tr>


                <?php endif; ?>


            </tbody>

        </table>

    </div>

</section>


<?php

// Memanggil footer
require_once '../includes/footer.php';

?>