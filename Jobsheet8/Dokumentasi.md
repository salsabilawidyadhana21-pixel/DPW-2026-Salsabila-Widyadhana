# Dokumentasi Jobsheet 8 — Koneksi PostgreSQL

## Tujuan
Menghubungkan aplikasi SIMPUS-Mini dengan database PostgreSQL menggunakan PHP dan PDO.

## Implementasi
Pada Jobsheet 8, penyimpanan data yang sebelumnya menggunakan `$_SESSION` pada Jobsheet 7 diganti dengan database PostgreSQL.

Database yang digunakan adalah `simpus_mini` dengan dua tabel utama, yaitu `buku` dan `anggota`.

Koneksi database dibuat menggunakan PDO dengan driver PostgreSQL (`pdo_pgsql`). Data buku dan anggota diproses menggunakan query SQL dan prepared statement.

## Fitur
- Koneksi PHP dengan PostgreSQL.
- Menambahkan data buku ke database.
- Menampilkan data buku dari database.
- Menambahkan data anggota ke database.
- Menampilkan data anggota dari database.
- Menampilkan jumlah buku dan anggota pada halaman utama.
- Menggunakan prepared statement untuk proses INSERT.
- Data tersimpan secara permanen di PostgreSQL.

## Database
Database:
`simpus_mini`

Tabel:
- `buku`
- `anggota`

## Cara Menjalankan
1. Jalankan PostgreSQL.
2. Pastikan database `simpus_mini` dan tabel `buku` serta `anggota` sudah dibuat.
3. Jalankan Laragon.
4. Pastikan Apache aktif.
5. Buka project melalui browser menggunakan `localhost`.

Contoh:
`http://localhost/Jobsheet8/`

## Hasil
Jobsheet 8 berhasil menghubungkan aplikasi SIMPUS-Mini dengan PostgreSQL sehingga data buku dan anggota dapat disimpan dan ditampilkan dari database secara permanen.
