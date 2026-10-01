<?php

// =====================================================
// HELPER FUNCTIONS
// Fungsi bantuan untuk keamanan dan validasi
// =====================================================


// =====================================================
// 1. ESCAPE OUTPUT
// Mencegah XSS ketika data ditampilkan ke HTML
// =====================================================

function e($value)
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}


// =====================================================
// 2. VALIDASI INTEGER
// Memastikan nilai merupakan bilangan bulat
// =====================================================

function validate_int($value)
{
    $result = filter_var(
        $value,
        FILTER_VALIDATE_INT
    );

    return $result !== false
        ? $result
        : null;
}


// =====================================================
// 3. VALIDASI PANJANG STRING
// Mengembalikan true jika panjang string
// tidak melebihi batas yang ditentukan
// =====================================================

function validate_length($value, $max)
{
    return strlen($value) <= $max;
}


// =====================================================
// 4. REDIRECT
// Mempermudah proses pengalihan halaman
// =====================================================

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

?>