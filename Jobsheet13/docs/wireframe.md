# Wireframe - Jobsheet 13

## SIMPUS Mini

Wireframe ini menggambarkan susunan halaman dan alur fitur peminjaman serta pengembalian buku.

### 1. Dashboard

```text
+------------------------------------------------------------------+
| SIMPUS MINI                                Pengguna | Logout      |
+----------------------+-------------------------------------------+
| MENU                 | DASHBOARD                                 |
|                      |                                           |
| Beranda              | [Total Buku] [Total Stok] [Anggota]        |
| Data Buku            |                                           |
| Data Anggota         | [Pinjaman Aktif] [Dikembalikan] [Terlambat]|
| Peminjaman           |                                           |
| Riwayat              | Ringkasan aktivitas perpustakaan           |
|                      |                                           |
+----------------------+-------------------------------------------+
```

### 2. Form Peminjaman

```text
+--------------------------------------------------------------+
|                    PEMINJAMAN BUKU                           |
+--------------------------------------------------------------+
|                                                              |
| Anggota:        [Pilih Anggota              v]                |
|                                                              |
| Buku:           [Pilih Buku                 v]                |
|                                                              |
| Tanggal Pinjam: [____-__-__]                                 |
|                                                              |
| Jatuh Tempo:    [____-__-__]                                 |
|                                                              |
|                 [Simpan Peminjaman]                          |
|                                                              |
|                 [Kembali]                                    |
+--------------------------------------------------------------+
```

### 3. Riwayat Peminjaman

```text
+------------------------------------------------------------------+
|                    RIWAYAT PEMINJAMAN                            |
+------------------------------------------------------------------+
| Anggota | Buku | Tgl Pinjam | Jatuh Tempo | Tgl Kembali | Status |
|---------|------|------------|-------------|-------------|--------|
| ...     | ...  | ...        | ...         | ...         | ...    |
| ...     | ...  | ...        | ...         | ...         | ...    |
| ...     | ...  | ...        | ...         | ...         | ...    |
+------------------------------------------------------------------+
```

### 4. Pengembalian Buku

```text
+--------------------------------------------------------------+
|                    PENGEMBALIAN BUKU                         |
+--------------------------------------------------------------+
|                                                              |
| Informasi Anggota: [Nama Anggota]                            |
| Informasi Buku:    [Judul Buku]                              |
| Tanggal Pinjam:    [Tanggal]                                 |
| Jatuh Tempo:       [Tanggal]                                 |
| Status:            [Dipinjam]                                |
|                                                              |
|                 [Proses Pengembalian]                        |
|                                                              |
|                 [Kembali]                                    |
+--------------------------------------------------------------+
```

### 5. Keterangan

* Dashboard menampilkan ringkasan data perpustakaan.
* Form peminjaman digunakan untuk mencatat transaksi baru.
* Riwayat menampilkan transaksi peminjaman dan pengembalian.
* Halaman pengembalian digunakan untuk menyelesaikan transaksi yang masih aktif.
* Sistem melakukan validasi sebelum menyimpan perubahan data.

Wireframe ini merupakan rancangan konseptual dan dapat disesuaikan dengan tampilan aplikasi yang telah dibuat.
