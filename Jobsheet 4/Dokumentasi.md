# Dokumentasi Wireframe & UI/UX — SIMUS-Mini

Dokumen ini mendeskripsikan secara rinci rancangan tata letak (*layout*) dan skenario penggunaan fitur dalam sistem informasi perpustakaan mini (**SIMUS-Mini**). Dokumentasi ini dibuat sebagai acuan sebelum tahap implementasi kode program.

---

## 1. Identifikasi Aktor & Hak Akses
* **Tamu / Anggota:** Dapat mengakses halaman publik (seperti katalog buku) untuk mencari referensi literatur.
* **Petugas Perpustakaan:** Memiliki akses penuh setelah login untuk mengelola sirkulasi buku, pencatatan anggota, serta memantau transaksi peminjaman dan pengembalian.

---

## 2. Alur Interaksi Sistem (User Flow)
Alur kerja utama pengguna di dalam aplikasi mengikuti tahapan berurutan berikut:
```text
[1. Login] -> [2. Dashboard] -> [3. Daftar Buku / Peminjaman] -> [4. Pengembalian] -> [5. Riwayat]
```

## 3. Rincian Tampilan Layar (Screens)

Berikut adalah penjabaran detail dari setiap rancangan tata letak (*layout*) dan komponen antarmuka yang terdapat dalam sistem:

### **01. Halaman Masuk (Login)**
* **Screen A: Halaman Login Petugas**
  * **Konsep Tata Letak (*Layout*):** Menggunakan desain *split-screen* (dua kolom). Sisi kiri didominasi oleh panel identitas visual dan *branding* aplikasi ("Semua buku. Lebih teratur."), sedangkan sisi kanan memuat kotak dialog formulir autentikasi.
  * **Komponen & Interaksi:**
    * Label sambutan *"Masuk ke SIMUS"*.
    * Kolom input teks untuk *Email petugas*.
    * Kolom input sandi untuk *Kata sandi*.
    * Tombol aksi utama berwarna biru dengan teks *"Masuk ke dashboard"* untuk melakukan verifikasi masuk sistem.

---

### **02. Area Kerja Petugas (Dashboard & Katalog)**
* **Screen B: Dashboard Petugas**
  * **Konsep Tata Letak (*Layout*):** Menggunakan struktur navigasi samping (*sidebar rail*) di sebelah kiri untuk akses menu yang cepat, serta area konten utama yang lapang di sebelah kanan.
  * **Komponen & Interaksi:**
    * **Kartu Metrik Utama:** Menampilkan ringkasan data penting secara real-time yang meliputi *Total koleksi*, *Sedang dipinjam*, *Jatuh tempo*, dan *Kunjungan* hari ini.
    * **Grafik Aktivitas:** Panel visual berupa diagram batang (*bar chart*) untuk memantau tren aktivitas peminjaman buku.
    * **Panel Informasi Tambahan:** Menampilkan daftar *Koleksi populer* serta tabel ringkasan *Aktivitas peminjaman terbaru* (meliputi informasi anggota, buku, tanggal, dan status).

* **Screen C: Daftar Buku (Katalog)**
  * **Konsep Tata Letak (*Layout*):** Halaman manajemen data berbasis tabel interaktif dengan panel kontrol di bagian atas untuk memudahkan pencarian dan pengelolaan inventaris.
  * **Komponen & Interaksi:**
    * Tombol aksi cepat *"Tambah buku"* di sudut kanan atas.
    * Filter status kategori buku (*Semua*, *Tersedia*, *Dipinjam*).
    * Tabel data katalog yang memuat kolom informasi: *Judul buku*, *Penulis*, *Kategori*, *Stok*, dan *Status ketersediaan* (ditandai dengan badge indikator warna).

---

### **03. Pengelolaan dan Transaksi (Sirkulasi)**
* **Screen D: Form Peminjaman**
  * **Konsep Tata Letak (*Layout*):** Halaman transaksi berbentuk formulir dua kolom yang memisahkan data peminjam di sisi kiri dan daftar buku yang akan dipinjam di sisi kanan.
  * **Komponen & Interaksi:**
    * Bagian Data Peminjam: Pilihan jenis anggota (*Mahasiswa/Umum*) dan kolom input nama/ID anggota.
    * Bagian Detail Peminjaman: Informasi tanggal pinjam otomatis dan batas tenggat waktu.
    * Panel Buku Pilihan: Ringkasan daftar buku yang dipilih beserta kode inventaris, serta tombol aksi *"Simpan peminjaman"* di bagian bawah.

* **Screen E: Pengembalian & Riwayat Transaksi**
  * **Konsep Tata Letak (*Layout*):** Halaman pengelolaan arsip sirkulasi yang memuat tabel data transaksional lengkap dengan fitur pencarian cepat.
  * **Komponen & Interaksi:**
    * Panel Pencarian Transaktif: Digunakan petugas untuk mencari data peminjaman aktif berdasarkan nama anggota atau ID guna mempercepat proses pengembalian buku.
    * Tabel Riwayat Rekapitulasi: Menampilkan rekam jejak seluruh transaksi perpustakaan (peminjaman dan pengembalian) yang dilengkapi informasi status denda/keterlambatan secara transparan.
