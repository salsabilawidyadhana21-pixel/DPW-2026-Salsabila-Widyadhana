# SIMPUS Mini — Jobsheet 12

## Deskripsi

SIMPUS Mini merupakan aplikasi sistem informasi perpustakaan sederhana berbasis PHP dan PostgreSQL. Pada Jobsheet 12, aplikasi dikembangkan dengan menambahkan fitur peminjaman, pengembalian, riwayat transaksi, dan ringkasan data pada dashboard.

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
