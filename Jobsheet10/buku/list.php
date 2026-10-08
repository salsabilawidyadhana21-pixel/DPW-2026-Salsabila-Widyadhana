<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once __DIR__ . '/../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENGAKSES
// DATA BUKU
// =====================================================

require_role(['admin', 'petugas']);


// =====================================================
// KONEKSI DATABASE
// =====================================================

require_once __DIR__ . '/../includes/koneksi.php';


// Judul halaman
$page_title = 'Data Buku';


// Memanggil header
require_once __DIR__ . '/../includes/header.php';


// =====================================================
// SEARCH
// =====================================================

$keyword = trim($_GET['keyword'] ?? '');


// Jika ada keyword pencarian
if ($keyword !== '') {

    $sql = "
        SELECT *
        FROM buku
        WHERE judul ILIKE :keyword
           OR pengarang ILIKE :keyword
           OR isbn ILIKE :keyword
           OR kategori ILIKE :keyword
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
        FROM buku
        ORDER BY id DESC
    ";

    // Query aman karena tidak mengandung
    // input dari user
    $stmt = $pdo->query($sql);
}


// Mengambil semua data buku
$buku = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<section class="page-header">

    <div>

        <span class="section-label">
            SIMPUS-Mini
        </span>

        <h1>
            Data Buku
        </h1>

        <p>
            Kelola data buku perpustakaan.
        </p>

    </div>


    <!-- Tombol tambah buku -->
    <a
        href="tambah.php"
        class="btn btn-primary">

        + Tambah Buku

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
            placeholder="Cari buku..."
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
         TABEL DATA BUKU
         ================================================= -->

    <div class="table-responsive">

        <table>

            <thead>

                <tr>

                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Tahun</th>
                    <th>ISBN</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Aksi</th>

                </tr>

            </thead>


            <tbody>


                <?php if (count($buku) > 0): ?>


                    <?php foreach ($buku as $index => $data): ?>


                        <tr>


                            <!-- Nomor -->
                            <td>
                                <?= $index + 1 ?>
                            </td>


                            <!-- Judul -->
                            <td>
                                <?= htmlspecialchars($data['judul']) ?>
                            </td>


                            <!-- Pengarang -->
                            <td>
                                <?= htmlspecialchars($data['pengarang']) ?>
                            </td>


                            <!-- Tahun -->
                            <td>
                                <?= (int) $data['tahun'] ?>
                            </td>


                            <!-- ISBN -->
                            <td>
                                <?= htmlspecialchars($data['isbn'] ?? '-') ?>
                            </td>


                            <!-- Stok -->
                            <td>
                                <?= (int) $data['stok'] ?>
                            </td>


                            <!-- Kategori -->
                            <td>
                                <?= htmlspecialchars($data['kategori'] ?? '-') ?>
                            </td>


                            <!-- Status -->
                            <td>
                                <?php $status = $data['status'] ?? 'Aktif'; ?>
                                <span style="color: <?= $status == 'Aktif' ? 'green' : 'red' ?>; font-weight: bold;">
                                    <?= htmlspecialchars($status) ?>
                                </span>
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


                                <!-- =========================
                                     TOMBOL TOGGLE STATUS (NONAKTIF/AKTIF)
                                     ========================= -->
                                <?php if (($data['status'] ?? 'Aktif') == 'Aktif'): ?>
                                    <a href="toggle_status.php?id=<?= (int) $data['id'] ?>&status=Nonaktif" 
                                       class="btn" style="background-color: #f0ad4e; color: #fff;"
                                       onclick="return confirm('Yakin ingin menonaktifkan buku ini?');">
                                       Nonaktifkan
                                    </a>
                                <?php else: ?>
                                    <a href="toggle_status.php?id=<?= (int) $data['id'] ?>&status=Aktif" 
                                       class="btn" style="background-color: #5cb85c; color: #fff;"
                                       onclick="return confirm('Yakin ingin mengaktifkan kembali buku ini?');">
                                       Aktifkan
                                    </a>
                                <?php endif; ?>


                                <!-- =========================
                                     FORM HAPUS
                                     ========================= -->

                                <form
                                    action="hapus.php"
                                    method="POST"
                                    style="display: inline;">


                                    <!-- ID buku -->
                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int) $data['id'] ?>">


                                    <!-- Tombol hapus -->
                                    <button
                                        type="submit"
                                        class="btn btn-hapus"
                                        onclick="return confirm('Yakin ingin menghapus data buku ini?');">

                                        Hapus

                                    </button>


                                </form>


                            </td>


                        </tr>


                    <?php endforeach; ?>


                <?php else: ?>


                    <tr>

                        <td
                            colspan="9"
                            style="text-align: center;">

                            Data buku tidak ditemukan.

                        </td>

                    </tr>


                <?php endif; ?>


            </tbody>

        </table>

    </div>

</section>


<?php

// Memanggil footer
require_once __DIR__ . '/../includes/footer.php';

?>