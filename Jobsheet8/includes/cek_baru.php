<?php
// Memaksa host menggunakan IP v4 agar tidak nyangkut ke (::1)
$dsn = "pgsql:host=127.0.0.1;port=5432;dbname=simpus_mini";
$user = "postgres";
$password = "salsa";

try {
    $pdo = new PDO($dsn, $user, $password);
    echo "<h1 style='color: green;'>ALHAMDULILLAH KONEKSI BERHASIL!</h1>";
} catch (PDOException $e) {
    echo "<h1 style='color: red;'>GAGAL:</h1>";
    echo "<pre>" . $e->getMessage() . "</pre>";
}
?>