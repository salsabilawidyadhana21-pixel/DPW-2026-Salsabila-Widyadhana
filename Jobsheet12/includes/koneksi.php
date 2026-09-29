<?php

$host = '127.0.0.1';
$port = '5433';
$dbname = 'simpus_mini';
$user = 'postgres';
$password = 'salsa';


// =====================================================
// Membuat koneksi menggunakan PDO
// =====================================================

try {

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password
    );


    // Mengatur PDO agar menampilkan error
    // dalam bentuk exception
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