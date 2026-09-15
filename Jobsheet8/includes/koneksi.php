<?php
$host = '127.0.0.1';
$port = '5432';
$db = 'simpus_mini';
$user = 'postgres';
$pass = 'salsa';

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";

echo "DEBUG DSN: " . $dsn . "<br>";

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>