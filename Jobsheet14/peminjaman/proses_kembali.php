<?php

// Memastikan user sudah login
require_once '../includes/auth.php';

// Admin dan petugas boleh memproses pengembalian
require_role(['admin', 'petugas']);

// Memanggil CSRF protection
require_once '../includes/csrf.php';

// Koneksi database
require_once '../includes/koneksi.php';

// Hanya menerima metode POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: riwayat.php');
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

// Mengambil ID peminjaman
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    exit('ID peminjaman tidak valid.');
}

try {

    // Memulai transaksi database
    $pdo->beginTransaction();

    // Mengunci data peminjaman agar tidak diproses dua kali
    $stmt = $pdo->prepare(
        "SELECT id, buku_id, status
         FROM peminjaman
         WHERE id = :id
         FOR UPDATE"
    );

    $stmt->execute([
        ':id' => $id
    ]);

    $peminjaman = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$peminjaman) {
        throw new Exception('Data peminjaman tidak ditemukan.');
    }

    // Memastikan buku masih dipinjam
    if ($peminjaman['status'] !== 'dipinjam') {
        throw new Exception('Buku ini sudah dikembalikan.');
    }

    // Memperbarui status dan tanggal pengembalian
    $stmtUpdate = $pdo->prepare(
        "UPDATE peminjaman
         SET status = 'dikembalikan',
             tanggal_kembali = CURRENT_DATE
         WHERE id = :id
           AND status = 'dipinjam'"
    );

    $stmtUpdate->execute([
        ':id' => $id
    ]);

    if ($stmtUpdate->rowCount() !== 1) {
        throw new Exception('Gagal memperbarui status peminjaman.');
    }

    // Menambahkan kembali stok buku
    $stmtStok = $pdo->prepare(
        "UPDATE buku
         SET stok = stok + 1
         WHERE id = :id"
    );

    $stmtStok->execute([
        ':id' => $peminjaman['buku_id']
    ]);

    if ($stmtStok->rowCount() !== 1) {
        throw new Exception('Gagal memperbarui stok buku.');
    }

    // Menyimpan perubahan
    $pdo->commit();

    // Kembali ke riwayat peminjaman
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

