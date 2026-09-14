# Jobsheet 7 — PHP Dasar & Form Handling

**Sub-CPMK:** Mengimplementasikan dasar PHP dan pengolahan form.

## Perubahan dari Jobsheet 6

- Halaman yang membutuhkan proses server diubah dari `.html` menjadi `.php`.
- Ditambahkan `includes/header.php` dan `includes/footer.php`.
- Form Tambah Buku dan Tambah Anggota menggunakan metode `POST`.
- Data form diproses menggunakan PHP melalui `proses_tambah.php`.
- Ditambahkan validasi data pada sisi server.
- Data buku dan anggota disimpan sementara menggunakan `$_SESSION`.
- Data ditampilkan pada halaman daftar menggunakan `foreach`.
- Ditambahkan flash message untuk informasi berhasil atau gagal.
- JavaScript dan CSS tetap digunakan untuk tampilan dan interaksi halaman.

## Cara Menjalankan

1. Buka **Laragon**.
2. Klik **Start All**.
3. Letakkan folder Jobsheet 7 di:

```text
C:\laragon\www\
```
4. Buka browser dan akses:
```
http://localhost/jobsheet-07/
```
## Catatan

Jobsheet 7 belum menggunakan database. Data masih disimpan sementara menggunakan $_SESSION sebagai tahap sebelum menggunakan database pada jobsheet berikutnya.
