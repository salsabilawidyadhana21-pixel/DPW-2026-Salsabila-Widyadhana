# SIMPUS Mini — Jobsheet 11

## Deskripsi

SIMPUS Mini merupakan aplikasi sistem informasi perpustakaan sederhana berbasis PHP dan PostgreSQL. Pada Jobsheet 11, aplikasi dikembangkan dengan menerapkan keamanan pada autentikasi, pengelolaan sesi, validasi input, dan pembatasan hak akses pengguna.

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

## Fitur Utama yang Ditambahkan

1. **Kolom Status pada Database**:
   - Menambahkan kolom `status` pada tabel buku untuk mengontrol ketersediaan data secara *soft delete* (tanpa harus menghapus baris data secara permanen dari database).

2. **Logika Toggle Status (`toggle_status.php`)**:
   - Berkas skrip backend baru yang menangani proses pembalikan status (mengubah status Aktif menjadi Nonaktif, dan sebaliknya) saat tombol aksi diklik oleh pengguna.

3. **Pembaruan Halaman Daftar Buku (`buku/list.php`)**:
   - Menyesuaikan tampilan antarmuka (UI) pada tabel daftar buku.
   - Menyertakan tombol interaktif untuk melakukan *toggle* status secara langsung dari halaman daftar.

## Teknologi yang Digunakan
- **PHP** (Native)
- **PostgreSQL** (Database Cloud via Supabase)
- **Laragon** (Untuk menjalankan web, sebelum menggunakan hosting render)
- **HTML/CSS & Bootstrap** (Antarmuka Pengguna)
- **Git & GitHub** (Kontrol Versi)
- **Render** (Deployment Aplikasi Web)

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
