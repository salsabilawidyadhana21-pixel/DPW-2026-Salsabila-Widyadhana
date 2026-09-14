# Wireframe & User Flow — SIMUS-Mini

Sub-CPMK: Merancang UI/UX aplikasi (proyek).

Halaman yang sudah ada: Beranda, Daftar Buku, Daftar Anggota — Jobsheet 1-3 baru mencakup fitur publik. Dashboard, Petugas, dan Peminjaman/Pengembalian. Dokumen ini merancang wireframe untuk halaman-halaman tersebut sebelum diimplementasikan mulai Jobsheet 5 dan seterusnya.

## Aktor

* **Tamu**: hanya bisa melihat katalog buku (Beranda, Daftar Buku) tanpa login.
* **Petugas**: login untuk mengelola seluruh fitur CRUD dan transaksi peminjaman.

---

## Alur Sistem (User Flow)

### 1. User Flow — Peminjaman Buku
```text
[Petugas Login] -> [Dashboard] -> [Pilih menu "Peminjaman"]
                  -> [Pilih Anggota] -> [Pilih Buku + Stok > 0]
                  -> [Simpan] -> [Flash status berhasil, stok di dashboard]
```

### 2. User Flow — Pengembalian Buku
```
[Dashboard] -> [Pilih "Pengembalian Buku"] -> [Cari transaksi / aktif / anggota/buku]
            -> [Klik "Pengembalian Buku"] -> [Cek denda/telat, update status]
            -> [Simpan Berhasil]
```

## Alur Wireframe 
### 1. Halaman Masuk

- Screen A (Login Petugas):

   - Halaman autentikasi terbagi dua kolom (panel informasi sistem di kiri dan form login di kanan).

   - Memuat input Email petugas, Kata sandi, dan tombol aksi Masuk ke dashboard.

```
+---------------------------------------------------+
| SIMUS-Mini                                        |
+---------------------------------------------------+
|                                                   |
|                 [ Login Petugas ]                 |
|                                                   |
|  Username : [                  ]                  |
|  Password : [                  ]                  |
|                                                   |
|                 [   Masuk   ]                     |
+---------------------------------------------------+
```

### 2. Area Kerja Petugas

- Screen B (Dashboard Petugas):

   - Dilengkapi menu navigasi samping (sidebar), kartu metrik ringkasan (Total koleksi, Sedang dipinjam, Jatuh tempo, Kunjungan), grafik aktivitas, dan tabel transaksi terbaru.

- Screen C (Daftar Buku):

   - Pusat kontrol katalog buku, tombol Tambah buku, filter status, dan tabel data inventaris buku.

```
+---------------------------------------------------------------------------------+
| SIMUS-Mini  |  Dashboard  |  Daftar Buku  |  Peminjaman  |  Pengembalian  | Riwayat |
+---------------------------------------------------------------------------------+
| [Total Koleksi]  [Sedang Dipinjam]  [Jatuh Tempo]  [Kunjungan Hari Ini]         |
|                                                                                 |
| Tabel / Grafik Aktivitas & Manajemen Buku                                       |
+---------------------------------------------------------------------------------+
```

### 3. Pengelolaan dan Transaksi
   
- Screen D (Form Peminjaman): Formulir dua kolom untuk mendata jenis anggota, identitas, tanggal pinjam, dan pilihan buku.

- Screen E (Pengembalian): Panel pencarian transaksi aktif untuk memproses pengembalian buku.

    - (Riwayat Transaksi): Tabel arsip rekapitulasi seluruh aktivitas sirkulasi dan status keterlambatan.

```
+---------------------------------------------------+
| Form Peminjaman & Pengembalian Buku               |
+---------------------------------------------------+
| [ Anggota / ID ]  ->  [ Pilih Buku & Stok > 0 ]   |
| [ Tombol Aksi : Simpan / Proses Pengembalian ]    |
+---------------------------------------------------+
```
