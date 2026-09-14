# Dokumentasi Jobsheet 7 — PHP Dasar & Form Handling

## 1. Identitas

**Mata Kuliah:** Pemrograman Web  
**Jobsheet:** 7  
**Materi:** PHP Dasar dan Pengolahan Form  
**Proyek:** SIMPUS-Mini  

---

## 2. Tujuan

Jobsheet 7 bertujuan untuk memahami dasar pemrograman PHP dan penerapannya pada pengolahan form. Pada jobsheet ini, website SIMPUS-Mini yang sebelumnya masih menggunakan HTML, CSS, JavaScript, JSON, dan `fetch()` mulai dikembangkan menggunakan PHP untuk memproses data pada sisi server.

Data yang dimasukkan melalui form diproses menggunakan `$_POST`, kemudian dilakukan validasi pada sisi server. Data yang valid disimpan sementara menggunakan `$_SESSION` dan ditampilkan kembali pada halaman daftar buku atau daftar anggota.

---

## 3. Perubahan dari Jobsheet 6

Pada Jobsheet 7 terdapat beberapa perubahan dari Jobsheet 6, yaitu:

1. File halaman yang membutuhkan proses server diubah dari `.html` menjadi `.php`.
2. Ditambahkan `includes/header.php` untuk bagian header dan navigasi.
3. Ditambahkan `includes/footer.php` untuk bagian footer.
4. Form tambah buku menggunakan metode `POST`.
5. Form tambah anggota menggunakan metode `POST`.
6. Ditambahkan file `proses_tambah.php` untuk memproses data form.
7. Data form diambil menggunakan superglobal `$_POST`.
8. Dilakukan validasi data pada sisi server menggunakan PHP.
9. Data buku disimpan sementara pada `$_SESSION['buku']`.
10. Data anggota disimpan sementara pada `$_SESSION['anggota']`.
11. Data pada halaman daftar ditampilkan menggunakan `foreach`.
12. Ditambahkan flash message menggunakan `$_SESSION` untuk memberikan informasi berhasil atau gagal.
13. File JSON dan JavaScript khusus untuk mengambil data menggunakan `fetch()` tidak lagi digunakan karena proses pengambilan dan penampilan data sudah dilakukan oleh PHP.

---

## 4. Struktur Folder

Struktur folder Jobsheet 7 yang digunakan adalah:

```text
Jobsheet 7/
├── anggota/
│   ├── list.php
│   ├── proses_tambah.php
│   └── tambah.php
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
│
├── buku/
│   ├── list.php
│   ├── proses_tambah.php
│   └── tambah.php
│
├── docs/
│   └── wireframe.md
│
├── includes/
│   ├── footer.php
│   └── header.php
│
├── Dokumentasi.md
├── index.php
└── README.md
```

## 5. Teknologi yang Digunakan

Teknologi yang digunakan pada Jobsheet 7 meliputi:

- HTML untuk struktur halaman.
- CSS untuk mengatur tampilan website.
- JavaScript untuk interaksi pada halaman seperti navigasi, pencarian, dan konfirmasi penghapusan.
- PHP untuk memproses data pada sisi server.
- Session PHP ($_SESSION) untuk menyimpan data sementara.
- Laragon sebagai lingkungan server lokal untuk menjalankan PHP.

## Cara Menjalankan
Project dijalankan menggunakan Laragon.

1. Buka Laragon.
2. Klik **Start All**.
3. Letakkan folder Jobsheet 7 di `C:\laragon\www`.
4. Buka project melalui browser menggunakan `localhost`.

Contoh:

```text
http://localhost/jobsheet-07/
```

## Hasil

Jobsheet 7 berhasil menerapkan PHP untuk memproses form, melakukan validasi server-side, menyimpan data sementara dalam session, dan menampilkan data pada halaman daftar.
