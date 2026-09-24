# Jobsheet 9 — CRUD Data Perpustakaan

Jobsheet 9 merupakan pengembangan dari sistem SIMPUS-Mini dengan menggunakan PHP dan database untuk mengelola data perpustakaan.

## Fitur
- Menampilkan data buku dari database.
- Menambahkan data buku.
- Menampilkan data anggota.
- Menambahkan data anggota.
- Pencarian data buku.
- Pesan berhasil atau gagal menggunakan flash message.
- Tampilan menggunakan CSS yang sudah dibuat pada jobsheet sebelumnya.
- Koneksi database menggunakan PDO.

## Struktur Utama
```
Jobsheet9/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
│
├── buku/
│   ├── list.php
│   ├── tambah.php
│   └── proses_tambah.php
│
├── anggota/
│   ├── list.php
│   ├── tambah.php
│   └── proses_tambah.php
│
├── includes/
│   ├── koneksi.php
│   ├── header.php
│   └── footer.php
│
└── index.php
```
## Teknologi
- HTML
- CSS
- JavaScript
- PHP
- PostgreSQL
- PDO
- Laragon
  
## Menjalankan Program
- Jalankan Laragon.
- Aktifkan Web Server dan database.
- Letakkan folder Jobsheet 9 di dalam folder www.
- Buka melalui browser.
- Gunakan menu Beranda, Daftar Buku, Tambah Buku, Daftar Anggota, dan Tambah Anggota.
