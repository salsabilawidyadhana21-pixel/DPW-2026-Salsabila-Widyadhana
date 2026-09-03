# SIMUS-Mini (Sistem Informasi Perpustakaan Mini)

Proyek ini dikembangkan untuk memenuhi tugas **Jobsheet 4 — Merancang UI/UX Aplikasi (Proyek)**. Repositori ini berisi rancangan alur kerja (*user flow*) dan *wireframe* antarmuka sistem informasi perpustakaan sebelum memasuki tahap implementasi pemrograman (PHP & PostgreSQL) di jobsheet berikutnya.

---

## Alur Sistem (User Flow)
Alur interaksi utama dalam aplikasi ini terbagi menjadi 5 tahapan utama:
```text
[1. Login] -> [2. Dashboard] -> [3. Daftar Buku / Peminjaman] -> [4. Pengembalian] -> [5. Riwayat]
```

## Penjelasan Wireframe & Rancangan Halaman
Berdasarkan hasil perancangan UI/UX, berikut adalah detail wireframe untuk setiap halaman utama sistem:

1. Screen A (Halaman Login Petugas):
   
- Layout: Terbagi menjadi dua bagian, yaitu panel informasi identitas aplikasi di sebelah kiri dan form autentikasi di sebelah kanan.
- Komponen: Input Email petugas, Kata sandi, serta tombol aksi utama Masuk ke dashboard.

2. Screen B (Dashboard Petugas):

- Layout: Menggunakan menu navigasi samping (sidebar rail) agar konsisten.
- Komponen: Kartu metrik ringkasan (Total koleksi, Sedang dipinjam, Jatuh tempo, Kunjungan hari ini), grafik batang aktivitas 7 hari terakhir, daftar koleksi populer, dan tabel ringkasan transaksi terbaru.

3. Screen C (Daftar Buku):

- Layout: Pusat kontrol katalog interaktif dengan filter kategori dan status.
- Komponen: Tombol Tambah buku, filter status (Semua, Tersedia, Dipinjam), serta tabel informasi judul, penulis, kategori, stok, dan status ketersediaan.

4. Screen D (Form Peminjaman):

- Layout: Tata letak formulir sirkulasi dua kolom (formulir input di kiri, ringkasan buku terpilih di kanan).
- Komponen: Pilihan jenis anggota, input nama/ID anggota, tanggal pinjam otomatis, pencarian buku, serta tombol Simpan peminjaman.

5. Screen E (Pengembalian & Riwayat Transaksi):

- Layout: Halaman pencarian dan pelacakan arsip sirkulasi.
- Komponen: Kolom pencarian cepat transaksi aktif untuk proses pengembalian, serta tabel rekapitulasi riwayat transaksi lengkap dengan status keterlambatan dan tombol ekspor data.

## Struktur Folder
```
jobsheet-04/
├── index.html              # Sama persis dengan jobsheet-03
├── assets/css/style.css    # Sama persis dengan jobsheet-03
├── buku/                    # Sama persis dengan jobsheet-03
├── anggota/                 # Sama persis dengan jobsheet-03
├── docs/
│   └── wireframe.md         # BARU — rancangan fitur yang belum dikoding
├── Infografis.png
├── README.md
└── Dokumentasi/            
```
