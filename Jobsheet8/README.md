# Jobsheet 8 — Koneksi PostgreSQL

**Sub-CPMK:** Menghubungkan aplikasi dengan basis data PostgreSQL.

## Perubahan dari Jobsheet 7
- Ditambahkan database PostgreSQL `simpus_mini`.
- Ditambahkan tabel `buku` dan `anggota`.
- Ditambahkan `includes/koneksi.php` untuk koneksi database menggunakan PDO.
- Data buku tidak lagi disimpan menggunakan `$_SESSION`, tetapi disimpan ke PostgreSQL.
- Data anggota tidak lagi disimpan menggunakan `$_SESSION`, tetapi disimpan ke PostgreSQL.
- Halaman daftar buku mengambil data menggunakan `SELECT` dari database.
- Halaman daftar anggota mengambil data menggunakan `SELECT` dari database.
- Statistik Total Buku dan Total Anggota mengambil jumlah data dari database.
- Proses INSERT menggunakan prepared statement.

## Struktur Database

Database:
- `simpus_mini`

Tabel:
- `buku`
- `anggota`

## Cara Menjalankan

1. Pastikan PostgreSQL sudah berjalan.
2. Pastikan database `simpus_mini` sudah dibuat.
3. Jalankan SQL pada folder `sql`.
4. Pastikan tabel `buku` dan `anggota` sudah tersedia.
5. Jalankan Laragon.
6. Klik **Start All**.
7. Buka project melalui browser.

Contoh:

`http://localhost/Jobsheet8/`

## Teknologi
- HTML
- CSS
- JavaScript
- PHP
- PostgreSQL
- PDO

## Catatan

Pada Jobsheet 8, data sudah tersimpan secara permanen di PostgreSQL. Berbeda dengan Jobsheet 7 yang masih menggunakan `$_SESSION` sebagai penyimpanan sementara.
