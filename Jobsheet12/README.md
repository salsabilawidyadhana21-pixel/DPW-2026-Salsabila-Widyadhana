# SIMPUS Mini — Jobsheet 12

## Deskripsi

SIMPUS Mini merupakan aplikasi sistem informasi perpustakaan sederhana berbasis PHP dan PostgreSQL. Pada Jobsheet 12, aplikasi dikembangkan dengan menambahkan fitur peminjaman, pengembalian, riwayat transaksi, dan ringkasan data pada dashboard.

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
* Pengelolaan data buku dan anggota.
* Pencatatan peminjaman buku.
* Proses pengembalian buku.
* Riwayat peminjaman.
* Dashboard dengan informasi jumlah buku, stok, anggota, dan status transaksi.
* Pengurangan stok saat peminjaman.
* Penambahan stok saat pengembalian.
* Pencegahan peminjaman baru bagi anggota yang memiliki pinjaman terlambat.
* Pembatasan akses berdasarkan role.
* Validasi input dan perlindungan CSRF.

## Struktur Folder

```text
Jobsheet12/
├── auth/
├── buku/
├── anggota/
├── peminjaman/
├── includes/
│   ├── koneksi.php
│   ├── header.php
│   └── footer.php
└── index.php
```

Struktur di atas merupakan gambaran umum. Sesuaikan dengan struktur proyek yang digunakan.

## Instalasi

1. Jalankan Laragon dan PostgreSQL.
2. Pastikan database `simpus_mini` sudah tersedia.
3. Pastikan tabel buku, anggota, users, dan peminjaman sudah tersedia.
4. Sesuaikan konfigurasi koneksi database pada `includes/koneksi.php`.
5. Letakkan folder Jobsheet12 pada direktori `www` Laragon.
6. Buka `http://localhost/Jobsheet12/` melalui browser.
7. Login menggunakan akun yang telah terdaftar.

## Alur Peminjaman

1. Petugas memilih anggota dan buku.
2. Sistem memvalidasi data serta ketersediaan stok.
3. Jika valid, transaksi peminjaman disimpan.
4. Stok buku berkurang dan transaksi tercatat pada riwayat.

## Alur Pengembalian

1. Petugas memilih transaksi yang masih dipinjam.
2. Sistem memproses pengembalian.
3. Status transaksi diperbarui menjadi dikembalikan.
4. Stok buku bertambah kembali.

## Keamanan

Aplikasi mempertahankan autentikasi, pembatasan role, validasi input, prepared statements, escape output, dan CSRF token.

## Catatan

Jobsheet 12 menggunakan database `simpus_mini` yang sama dengan Jobsheet sebelumnya. Hindari menjalankan ulang skrip yang menghapus data atau memasukkan data contoh secara duplikat.
