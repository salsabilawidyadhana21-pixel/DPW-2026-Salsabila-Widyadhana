# Dokumentasi Jobsheet 12

## Peminjaman dan Pengembalian Buku

### 1. Tujuan

Jobsheet 12 bertujuan untuk mengembangkan SIMPUS Mini dengan menambahkan fitur transaksi peminjaman dan pengembalian buku, riwayat transaksi, serta informasi statistik pada dashboard.

### 2. Implementasi Fitur

#### A. Peminjaman Buku

Fitur peminjaman digunakan untuk mencatat transaksi buku yang dipinjam oleh anggota perpustakaan.

Alur proses:

1. Petugas membuka halaman peminjaman.
2. Petugas memilih anggota dan buku.
3. Petugas mengisi tanggal peminjaman dan tanggal jatuh tempo.
4. Sistem memvalidasi data, ketersediaan stok, dan status pinjaman anggota.
5. Jika data valid, transaksi disimpan ke database dan stok buku dikurangi.

#### B. Pengembalian Buku

Fitur pengembalian digunakan untuk memperbarui status transaksi ketika anggota mengembalikan buku.

Alur proses:

1. Petugas membuka data peminjaman yang masih aktif.
2. Petugas memilih transaksi yang akan dikembalikan.
3. Sistem memproses pengembalian dan memperbarui status transaksi.
4. Stok buku ditambahkan kembali.

#### C. Riwayat Peminjaman

Riwayat peminjaman digunakan untuk melihat data transaksi yang telah dilakukan, termasuk informasi anggota, buku, tanggal peminjaman, tanggal jatuh tempo, tanggal pengembalian, dan status transaksi.

#### D. Dashboard

Dashboard menampilkan informasi yang dihitung dari database, meliputi:

* Total buku.
* Total stok buku.
* Jumlah anggota.
* Jumlah peminjaman aktif.
* Jumlah buku yang telah dikembalikan.
* Jumlah peminjaman terlambat.

#### E. Validasi Keterlambatan

Sistem mencegah anggota melakukan peminjaman baru apabila masih memiliki pinjaman yang telah melewati tanggal jatuh tempo dan belum dikembalikan.

### 3. Struktur Database

Tabel yang digunakan dalam fitur ini:

* **buku:** menyimpan informasi buku dan jumlah stok.
* **anggota:** menyimpan data anggota perpustakaan.
* **users:** menyimpan akun pengguna dan role.
* **peminjaman:** menyimpan transaksi peminjaman, relasi buku dan anggota, tanggal transaksi, serta status.

### 4. Pengujian

Pengujian yang telah dilakukan:

* Membuat transaksi peminjaman.
* Memastikan transaksi muncul pada riwayat.
* Memproses pengembalian buku.
* Memastikan stok berkurang saat peminjaman dan bertambah saat pengembalian.
* Memeriksa informasi dashboard.
* Menguji transaksi peminjaman dan pengembalian hingga selesai untuk dua transaksi.

Fitur utama Jobsheet 12 telah dilaporkan berjalan dengan baik.

### 5. Kesimpulan

Jobsheet 12 berhasil mengembangkan SIMPUS Mini dengan fitur peminjaman, pengembalian, riwayat transaksi, dan dashboard dinamis. Sistem juga menerapkan validasi ketersediaan stok dan keterlambatan untuk mendukung pengelolaan transaksi perpustakaan.
