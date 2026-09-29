# SIMPUS Mini — Jobsheet 11

## Deskripsi

SIMPUS Mini merupakan aplikasi sistem informasi perpustakaan sederhana berbasis PHP dan PostgreSQL. Pada Jobsheet 11, aplikasi dikembangkan dengan menerapkan keamanan pada autentikasi, pengelolaan sesi, validasi input, dan pembatasan hak akses pengguna.

## Teknologi

* PHP
* PostgreSQL
* PDO
* HTML
* CSS
* JavaScript
* Laragon

## Fitur

* Login dan autentikasi pengguna.
* Pengelolaan data buku.
* Pengelolaan data anggota.
* Pembatasan hak akses berdasarkan role admin dan petugas.
* Validasi input.
* Prepared statements untuk query database.
* Escape output untuk mencegah XSS.
* Perlindungan CSRF pada form.
* Password hashing.
* Manajemen sesi yang lebih aman.

## Struktur Folder

```text
Jobsheet11/
├── auth/
├── buku/
├── anggota/
├── includes/
│   ├── koneksi.php
│   ├── header.php
│   └── footer.php
└── index.php
```

Struktur di atas merupakan gambaran umum dan dapat disesuaikan dengan struktur proyek.

## Instalasi

1. Jalankan Laragon dan PostgreSQL.
2. Pastikan database `simpus_mini` sudah tersedia.
3. Sesuaikan konfigurasi koneksi database pada `includes/koneksi.php`.
4. Letakkan folder Jobsheet11 pada direktori `www` Laragon.
5. Jalankan aplikasi melalui browser dengan alamat `http://localhost/Jobsheet11/`.
6. Login menggunakan akun yang telah terdaftar.

## Keamanan

Aplikasi menerapkan prepared statements, validasi input, escape output, CSRF token, password hashing, manajemen sesi, dan pembatasan hak akses pengguna.

## Pengguna

* **Admin:** memiliki akses administratif sesuai aturan role pada aplikasi.
* **Petugas:** memiliki akses terhadap fitur operasional perpustakaan sesuai hak akses yang ditetapkan.

## Pengujian

Pengujian dilakukan terhadap login, validasi input, perlindungan SQL injection, XSS, dan pembatasan akses.

## Catatan

Jangan menyimpan password database atau informasi rahasia lainnya secara langsung di repository GitHub.
