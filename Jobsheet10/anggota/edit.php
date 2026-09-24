<?php

require_once '../includes/auth.php';
require_role(['admin', 'petugas']);

require_once '../includes/koneksi.php';

$page_title = 'Edit Anggota';

// Pastikan ID tersedia
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: list.php');
    exit;
}

$id = (int) $_GET['id'];

// Ambil data anggota berdasarkan ID
$sql = "
    SELECT *
    FROM anggota
    WHERE id = :id
";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':id' => $id
]);

$anggota = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika data tidak ditemukan
if (!$anggota) {
    header('Location: list.php');
    exit;
}

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

    <a
        href="list.php"
        class="btn btn-secondary">

        Kembali

    </a>

</section>


<section class="content-card form-card">

    <form
        action="proses_edit.php"
        method="POST">

        <input
            type="hidden"
            name="id"
            value="<?= $anggota['id'] ?>">


        <div class="form-group">

            <label for="nama">
                Nama
            </label>

            <input
                type="text"
                id="nama"
                name="nama"
                value="<?= htmlspecialchars($anggota['nama']) ?>"
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
                value="<?= htmlspecialchars($anggota['no_anggota']) ?>"
                required>

        </div>


        <div class="form-group">

            <label for="alamat">
                Alamat
            </label>

            <textarea
                id="alamat"
                name="alamat"><?= htmlspecialchars($anggota['alamat'] ?? '') ?></textarea>

        </div>


        <div class="form-group">

            <label for="no_hp">
                No. HP
            </label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
                value="<?= htmlspecialchars($anggota['no_hp'] ?? '') ?>">

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

                Simpan Perubahan

            </button>

        </div>

    </form>

</section>


<?php

require_once '../includes/footer.php';

?>