<?php

$page_title = "Tambah Anggota";

require_once '../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

?>

<section>

    <h2>Tambah Anggota</h2>

    <?php if ($flash): ?>

        <div class="flash <?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['pesan']) ?>
        </div>

    <?php endif; ?>

    <form action="proses_tambah.php" method="POST">

        <div class="form-group">
            <label for="nama">Nama</label>

            <input
                type="text"
                id="nama"
                name="nama"
                required
            >
        </div>

        <div class="form-group">
            <label for="no_anggota">
                No. Anggota
            </label>

            <input
                type="text"
                id="no_anggota"
                name="no_anggota"
                required
            >
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>

            <textarea
                id="alamat"
                name="alamat"
                rows="4"
            ></textarea>
        </div>

        <div class="form-group">
            <label for="no_hp">No. HP</label>

            <input
                type="text"
                id="no_hp"
                name="no_hp"
            >
        </div>

        <button type="submit" class="btn">
            Simpan
        </button>

    </form>

</section>

<?php require_once '../includes/footer.php'; ?>