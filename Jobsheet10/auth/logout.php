<?php

// LOGOUT

// Memulai session
session_start();


// =====================================================
// Menghapus seluruh data session
// =====================================================

session_unset();


// Menghancurkan session
session_destroy();


// =====================================================
// Setelah logout, user diarahkan kembali ke login
// =====================================================

header('Location: login.php');
exit;

?>