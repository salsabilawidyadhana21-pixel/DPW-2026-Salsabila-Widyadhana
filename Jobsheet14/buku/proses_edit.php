<?php

// =====================================================
// MEMASTIKAN USER SUDAH LOGIN
// =====================================================

require_once '../includes/auth.php';


// =====================================================
// HANYA ADMIN DAN PETUGAS YANG BOLEH MENGEDIT BUKU
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

    header('Location: list.php');
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
// 3. VALIDASI ID
// =====================================================

$id = filter_input(
    INPUT_POST,
    'id',
    FILTER_VALIDATE_INT
);


if ($id === false || $id === null || $id <= 0) {

    die('ID buku tidak valid.');
}


// =====================================================
// 4. MENGAMBIL DATA FORM
// =====================================================

$judul = trim($_POST['judul'] ?? '');

$pengarang = trim($_POST['pengarang'] ?? '');

$isbn = trim($_POST['isbn'] ?? '');

$kategori = trim($_POST['kategori'] ?? '');


// =====================================================
// 5. VALIDASI TAHUN
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
// 6. VALIDASI STOK
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
// 7. VALIDASI DATA WAJIB
// =====================================================

if ($judul === '' || $pengarang === '') {

    die(
        'Judul dan pengarang wajib diisi.'
    );
}


// =====================================================
// 8. VALIDASI PANJANG DATA
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
// 9. UPDATE DATA BUKU
// Menggunakan prepared statement
// =====================================================

try {

    $stmt = $pdo->prepare(
        "UPDATE buku
         SET
            judul = :judul,
            pengarang = :pengarang,
            tahun = :tahun,
            isbn = :isbn,
            stok = :stok,
            kategori = :kategori
         WHERE id = :id"
    );


    $stmt->execute([

        ':judul' => $judul,

        ':pengarang' => $pengarang,

        ':tahun' => $tahun,

        ':isbn' => $isbn !== ''
            ? $isbn
            : null,

        ':stok' => $stok,

        ':kategori' => $kategori !== ''
            ? $kategori
            : null,

        ':id' => $id

    ]);


    // Setelah berhasil diubah
    // kembali ke daftar buku
    header('Location: list.php');
    exit;


} catch (PDOException $e) {

    // Jangan menampilkan detail database
    // kepada pengguna
    die(
        'Gagal mengubah data buku.'
    );

}

?>