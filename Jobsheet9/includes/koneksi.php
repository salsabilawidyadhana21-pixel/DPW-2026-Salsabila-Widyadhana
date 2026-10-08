<?php

// =====================================================
// PENGATURAN DATABASE SUPABASE (Aman & Sesuai Jobsheet 13 Poin 2)
// =====================================================

// PHP akan otomatis mengambil URL database secara rahasia dari environment Render.
// Kredensial password tidak akan pernah bocor atau terlihat di GitHub Publik.
// Jika dijalankan di localhost laptop, dia akan otomatis beralih ke database lokal.
$db_url = getenv('DATABASE_URL') ?: "postgresql://postgres:salsa@127.0.0.1:5433/simpus_mini";

$db = parse_url($db_url);

$host     = $db["host"];
$port     = $db["port"];
$user     = $db["user"];
$password = $db["pass"] ?? '';
$dbname   = ltrim($db["path"], '/');

// =====================================================
// Membuat koneksi menggunakan PDO
// =====================================================

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=require";
    
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true // Wajib untuk connection pooler Supabase
    ]);

} catch (PDOException $e) {
    // Pesan eror umum aman agar tidak membocorkan informasi host/user ke luar saat terjadi kendala
    die("Koneksi database gagal. Silakan hubungi administrator.");
}

?>
