# Jobsheet 10 — SIMPUS-Mini

## Deskripsi

Jobsheet 10 merupakan pengembangan dari **Jobsheet 9** dengan menambahkan **autentikasi pengguna dan manajemen session**.

Pada jobsheet ini, pengguna harus melakukan login sebelum dapat mengakses halaman yang membutuhkan autentikasi.

## Fitur

- Register pengguna
- Login pengguna
- Logout
- Manajemen session
- Role pengguna
- Pembatasan akses halaman
- Role `admin`
- Role `petugas`
- Proteksi halaman menggunakan `require_role()`

## Fitur Utama yang Ditambahkan

1. **Kolom Status pada Database**:
   - Menambahkan kolom `status` pada tabel buku untuk mengontrol ketersediaan data secara *soft delete* (tanpa harus menghapus baris data secara permanen dari database).

2. **Logika Toggle Status (`toggle_status.php`)**:
   - Berkas skrip backend baru yang menangani proses pembalikan status (mengubah status Aktif menjadi Nonaktif, dan sebaliknya) saat tombol aksi diklik oleh pengguna.

3. **Pembaruan Halaman Daftar Buku (`buku/list.php`)**:
   - Menyesuaikan tampilan antarmuka (UI) pada tabel daftar buku.
   - Menyertakan tombol interaktif untuk melakukan *toggle* status secara langsung dari halaman daftar.

## Struktur Folder

```text
Jobsheet10/
├── auth/
│   ├── register.php
│   ├── login.php
│   └── logout.php
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
│   ├── footer.php
│   └── auth.php
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
- PHP Session
- Laragon
- Render
- Akun Pengguna

## Sistem menggunakan dua role:

- admin
- petugas

## Data pengguna disimpan pada tabel users dengan data:

- id
- nama
- username
- password
- role
- URL

## Halaman Register
```
http://localhost/Jobsheet10/auth/register.php
```

## Halaman Login
```
http://localhost/Jobsheet10/auth/login.php
```

## Alur Sistem
```
Register
   ↓
Login
   ↓
Validasi username dan password
   ↓
Session dibuat
   ↓
Masuk ke sistem
   ↓
Mengakses fitur sesuai role
   ↓
Logout
```
