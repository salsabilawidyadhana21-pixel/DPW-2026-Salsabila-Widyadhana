<?php
// Pastikan session selalu aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek status login (tanpa me-redirect pengguna)
$isLoggedIn = isset($_SESSION['user_id']);
$currentUser = $_SESSION['username'] ?? $_SESSION['nama'] ?? null;