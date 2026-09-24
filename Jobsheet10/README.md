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
