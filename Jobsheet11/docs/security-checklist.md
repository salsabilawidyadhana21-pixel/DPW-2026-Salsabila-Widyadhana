# Checklist Jobsheet 11

## Keamanan Aplikasi SIMPUS Mini

### Implementasi

* [x] Menggunakan PDO prepared statements.
* [x] Menerapkan escape output untuk mengurangi risiko XSS.
* [x] Menerapkan CSRF token pada form yang sesuai.
* [x] Melakukan validasi input pengguna.
* [x] Menerapkan password hashing.
* [x] Menggunakan verifikasi password saat login.
* [x] Menerapkan manajemen sesi yang lebih aman.
* [x] Menerapkan pembatasan hak akses berdasarkan role.
* [x] Membatasi penghapusan anggota untuk admin.
* [x] Menerapkan validasi panjang dan nilai input.

### Pengujian

* [x] Menguji SQL Injection pada login.
* [x] Menguji input script untuk memastikan output di-escape.
* [x] Menguji pendaftaran dengan password minimal 8 karakter.
* [x] Menguji batas input stok negatif.
* [x] Menguji autentikasi dan pembatasan role.

### Pemeriksaan Akhir

* [x] Memeriksa halaman menggunakan akun admin.
* [x] Memeriksa halaman menggunakan akun petugas.
* [x] Memastikan seluruh fitur berjalan dengan baik pada versi final.
