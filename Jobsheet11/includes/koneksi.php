<?php

// =====================================================
// PENGATURAN DATABASE SUPABASE
// =====================================================

// PENTING: Ganti tulisan MASUKKAN_PASSWORD_ASLI_KAMU dengan password asli Anda!
$db_url = "postgresql://postgres.zzdjhzlnqqhdshjrzkef:lenovointelcore@aws-0-ap-southeast-1.pooler.supabase.com:6543/postgres";


// =====================================================
// Memecah URL Supabase secara otomatis (Jangan Diubah)
// =====================================================
$db = parse_url($db_url);

$host     = $db["host"];
$port     = $db["port"];
$user     = $db["user"];
$password = $db["pass"];
$dbname   = ltrim($db["path"], '/');


// =====================================================
// Membuat koneksi menggunakan PDO
// =====================================================

try {

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );

    // Mengatur PDO agar menampilkan error dalam bentuk exception
    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    // Jika koneksi gagal
    die(
        'Koneksi database gagal: ' .
        $e->getMessage()
    );

}

?>