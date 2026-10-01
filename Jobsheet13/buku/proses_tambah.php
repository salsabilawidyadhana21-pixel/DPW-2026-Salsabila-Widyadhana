<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENAMBAH BUKU
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


// =====================================================
// 1. MEMASTIKAN REQUEST MENGGUNAKAN POST
// =====================================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: tambah.php');
    exit;
}


// =====================================================
// 2. VERIFIKASI TOKEN CSRF
// =====================================================

$csrf_token = $_POST['csrf_token'] ?? '';

if (!verify_csrf_token($csrf_token)) {

    die('Token CSRF tidak valid.');
}


// =====================================================
// 3. MENGAMBIL DATA DARI FORM
// =====================================================

$judul = trim($_POST['judul'] ?? '');

$pengarang = trim($_POST['pengarang'] ?? '');

$isbn = trim($_POST['isbn'] ?? '');

$kategori = trim($_POST['kategori'] ?? '');


// =====================================================
// 4. VALIDASI TAHUN
// =====================================================

$tahun = filter_input(
    INPUT_POST,
    'tahun',
    FILTER_VALIDATE_INT
);

if ($tahun === false || $tahun === null) {

    die('Tahun harus berupa angka.');
}


// =====================================================
// 5. VALIDASI STOK
// =====================================================

$stok = filter_input(
    INPUT_POST,
    'stok',
    FILTER_VALIDATE_INT
);

if ($stok === false || $stok === null || $stok < 0) {

    die('Stok harus berupa angka dan tidak boleh negatif.');
}


// =====================================================
// 6. VALIDASI DATA WAJIB
// =====================================================

if ($judul === '' || $pengarang === '') {

    die(
        'Judul dan pengarang wajib diisi.'
    );
}


// =====================================================
// 7. VALIDASI PANJANG STRING
// =====================================================

if (strlen($judul) > 150) {

    die('Judul maksimal 150 karakter.');
}


if (strlen($pengarang) > 100) {

    die('Pengarang maksimal 100 karakter.');
}


if (strlen($isbn) > 30) {

    die('ISBN maksimal 30 karakter.');
}


if (strlen($kategori) > 30) {

    die('Kategori maksimal 30 karakter.');
}


// =====================================================
// 8. MENYIMPAN DATA
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "INSERT INTO buku
        (
            judul,
            pengarang,
            tahun,
            isbn,
            stok,
            kategori
        )
        VALUES
        (
            :judul,
            :pengarang,
            :tahun,
            :isbn,
            :stok,
            :kategori
        )"
    );


    $stmt->execute([

        ':judul' => $judul,

        ':pengarang' => $pengarang,

        ':tahun' => $tahun,

        ':isbn' => $isbn !== '' ? $isbn : null,

        ':stok' => $stok,

        ':kategori' => $kategori !== ''
            ? $kategori
            : null

    ]);


    // Setelah berhasil disimpan
    // kembali ke daftar buku
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jangan menampilkan detail database
    // kepada pengguna
    die(
        'Gagal menambahkan data buku.'
    );

}

?>