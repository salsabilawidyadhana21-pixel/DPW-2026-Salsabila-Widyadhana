<?php

// Memastikan user sudah login
require_once '../includes/auth.php';

// Admin dan petugas boleh melakukan peminjaman
require_role(['admin', 'petugas']);

// Memanggil CSRF protection
require_once '../includes/csrf.php';

// Koneksi database
require_once '../includes/koneksi.php';

// Hanya menerima metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: tambah.php');
    exit;
}

// Memeriksa token CSRF
$token = $_POST['csrf_token'] ?? '';

if (
    !is_string($token) ||
    !hash_equals(csrf_token(), $token)
) {
    http_response_code(403);
    exit('Token CSRF tidak valid.');
}

// Mengambil data dari form
$anggota_id = filter_input(INPUT_POST, 'anggota_id', FILTER_VALIDATE_INT);
$buku_id = filter_input(INPUT_POST, 'buku_id', FILTER_VALIDATE_INT);
$tanggal_pinjam = $_POST['tanggal_pinjam'] ?? '';
$tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'] ?? '';

// Validasi ID
if (!$anggota_id || !$buku_id) {
    exit('Anggota dan buku wajib dipilih.');
}

// Validasi format tanggal
function tanggalValid($tanggal)
{
    if (!is_string($tanggal)) {
        return false;
    }

    $date = DateTime::createFromFormat('!Y-m-d', $tanggal);

    return $date && $date->format('Y-m-d') === $tanggal;
}

if (
    !tanggalValid($tanggal_pinjam) ||
    !tanggalValid($tanggal_jatuh_tempo)
) {
    exit('Format tanggal tidak valid.');
}

// Tanggal jatuh tempo tidak boleh sebelum tanggal pinjam
if ($tanggal_jatuh_tempo < $tanggal_pinjam) {
    exit('Tanggal jatuh tempo tidak boleh sebelum tanggal pinjam.');
}

try {

    // Memulai transaksi database
    $pdo->beginTransaction();

    // Memastikan anggota terdaftar
    $stmtAnggota = $pdo->prepare(
        "SELECT id
         FROM anggota
         WHERE id = :id"
    );

    $stmtAnggota->execute([
        ':id' => $anggota_id
    ]);

    if (!$stmtAnggota->fetch()) {
        throw new Exception('Anggota tidak ditemukan.');
    }

    // Memeriksa apakah anggota memiliki pinjaman terlambat
    $stmtTerlambat = $pdo->prepare(
        "SELECT id
         FROM peminjaman
         WHERE anggota_id = :anggota_id
           AND status = 'dipinjam'
           AND tanggal_jatuh_tempo < CURRENT_DATE
         LIMIT 1"
    );

    $stmtTerlambat->execute([
        ':anggota_id' => $anggota_id
    ]);

    if ($stmtTerlambat->fetch()) {
        throw new Exception(
            'Anggota memiliki pinjaman yang terlambat dan belum dikembalikan.'
        );
    }

    // Mengunci data buku untuk mencegah stok berkurang bersamaan
    $stmtBuku = $pdo->prepare(
        "SELECT id, stok
         FROM buku
         WHERE id = :id
         FOR UPDATE"
    );

    $stmtBuku->execute([
        ':id' => $buku_id
    ]);

    $buku = $stmtBuku->fetch(PDO::FETCH_ASSOC);

    if (!$buku) {
        throw new Exception('Buku tidak ditemukan.');
    }

    if ((int) $buku['stok'] <= 0) {
        throw new Exception('Stok buku sedang tidak tersedia.');
    }

    // Menyimpan data peminjaman
    $stmtInsert = $pdo->prepare(
        "INSERT INTO peminjaman
            (buku_id, anggota_id, tanggal_pinjam,
             tanggal_jatuh_tempo, status)
         VALUES
            (:buku_id, :anggota_id, :tanggal_pinjam,
             :tanggal_jatuh_tempo, 'dipinjam')"
    );

    $stmtInsert->execute([
        ':buku_id' => $buku_id,
        ':anggota_id' => $anggota_id,
        ':tanggal_pinjam' => $tanggal_pinjam,
        ':tanggal_jatuh_tempo' => $tanggal_jatuh_tempo
    ]);

    // Mengurangi stok buku
    $stmtUpdate = $pdo->prepare(
        "UPDATE buku
         SET stok = stok - 1
         WHERE id = :id
           AND stok > 0"
    );

    $stmtUpdate->execute([
        ':id' => $buku_id
    ]);

    if ($stmtUpdate->rowCount() !== 1) {
        throw new Exception('Gagal memperbarui stok buku.');
    }

    // Menyimpan perubahan
    $pdo->commit();

    // Kembali ke halaman riwayat
    header('Location: riwayat.php');
    exit;

} catch (Exception $e) {

    // Membatalkan perubahan jika terjadi kesalahan
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }

    http_response_code(400);
    exit(htmlspecialchars(
        $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    ));
}

