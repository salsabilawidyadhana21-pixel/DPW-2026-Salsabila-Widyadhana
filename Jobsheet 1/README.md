# Dokumentasi Jobsheet 1 — SIMUS Mini

Dokumentasi ini dibuat untuk menjelaskan project SIMUS Mini pada Jobsheet 1. Setiap file HTML dijelaskan berdasarkan fungsi halaman, struktur yang digunakan, serta kegunaan elemen HTML5 semantic dalam pembuatan website sederhana.

# Daftar Isi

1. Konsep Dasar yang Dipakai di Jobsheet Ini
2. Penjelasan index.html (Halaman Beranda)
3. Penjelasan buku/list.html (Daftar Buku)
4. Penjelasan buku/tambah.html (Form Tambah Buku)
5. Penjelasan anggota/list.html (Daftar Anggota)
6. Penjelasan anggota/tambah.html (Form Tambah Anggota)
7. Rangkuman

# Tentang Program Ini

Jobsheet 1 membangun kerangka awal aplikasi SIMUS Mini, yaitu sistem informasi perpustakaan sederhana yang digunakan untuk menampilkan dan mengelola data buku serta anggota.

Pada tahap Jobsheet 1, website masih menggunakan HTML saja. Data yang ditampilkan masih berupa data dummy atau data contoh. Tombol Edit, Hapus, dan Simpan juga belum memiliki fungsi karena belum menggunakan JavaScript, PHP, atau database.

Struktur HTML yang digunakan pada project ini menggunakan beberapa tag HTML5 semantic, yaitu:

- header digunakan sebagai bagian kepala halaman.
- nav digunakan untuk membuat menu navigasi.
- main digunakan sebagai bagian konten utama.
- section digunakan untuk membagi konten berdasarkan bagian tertentu.
- article digunakan untuk menampilkan informasi yang berdiri sendiri.
- footer digunakan sebagai bagian bawah halaman.
- div belum digunakan sebagai struktur utama karena Jobsheet 1 berfokus pada penggunaan semantic HTML.

Selain itu, digunakan juga atribut id dan name pada form. Penamaan atribut tersebut dibuat konsisten agar lebih mudah digunakan pada tahap pengembangan berikutnya.

# Struktur Folder

```
Struktur Folder
simus-mini/
│
├── index.html
│
├── buku/
│   ├── list.html
│   └── tambah.html
│
└── anggota/
    ├── list.html
    └── tambah.html
```

Keterangan:

```
simus-mini/
│
├── index.html              # Halaman utama atau Beranda
│
├── buku/
│     ├── list.html         # Halaman daftar buku
│     └── tambah.html       # Halaman form tambah buku
│
└── anggota/
        ├── list.html       # Halaman daftar anggota
        └── tambah.html     # Halaman form tambah anggota
```
Semua halaman tersebut saling terhubung menggunakan tag a dan atribut href.

# 1. Konsep Dasar yang Dipakai di Jobsheet Ini
### Struktur Dasar HTML

Setiap halaman dimulai dengan struktur dasar HTML berikut:

```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Judul Halaman</title>
</head>

<body>

</body>
</html>
```

### Penjelasan

```
<!DOCTYPE html>
```
Digunakan untuk memberi tahu browser bahwa dokumen yang dibuat menggunakan standar HTML5.

```
<html lang="id">
```
Merupakan elemen utama dari dokumen HTML. Atribut lang="id" menunjukkan bahwa bahasa utama halaman adalah Bahasa Indonesia.

```
<head>
```
Digunakan untuk menyimpan informasi mengenai halaman yang tidak langsung ditampilkan sebagai isi halaman.

```
<meta charset="UTF-8">
```
Digunakan agar halaman dapat menampilkan karakter dan simbol dengan benar.

```
<meta name="viewport">
```
Digunakan agar halaman dapat menyesuaikan ukuran layar perangkat.

```
<title>
```
Digunakan untuk menentukan judul halaman yang muncul pada tab browser.

```
<body>
```
Berisi seluruh konten yang akan ditampilkan kepada pengguna.

# Jobsheet 1 menghasilkan project SIMUS Mini yang terdiri dari lima halaman:

index.html
→ Halaman Beranda

buku/list.html
→ Daftar Buku

buku/tambah.html
→ Form Tambah Buku

anggota/list.html
→ Daftar Anggota

anggota/tambah.html
→ Form Tambah Anggota

Materi utama yang diterapkan adalah HTML5 semantic, navigasi antarhalaman, tabel, dan form.

HTML5 semantic yang digunakan yaitu:
```
<header>
<nav>
<main>
<section>
<article>
<footer>
```
Project ini masih berupa struktur dasar sehingga data belum diproses menggunakan database. Struktur yang dibuat akan menjadi dasar untuk pengembangan tampilan menggunakan CSS pada Jobsheet berikutnya.

# Berikut jawaban Latihan Reflektif 6.5:

1. Kenapa field Alamat dan No. HP diberi required, sedangkan Nama dan No. Anggota tidak?

Field Alamat dan No. HP diberi atribut required agar pengguna wajib mengisi data tersebut sebelum form dapat dikirim. Sedangkan Nama dan No. Anggota tidak diberi required, sehingga pengguna masih dapat mengosongkannya.

Namun, dalam penggunaan sebenarnya, Nama dan No. Anggota sebaiknya juga diberi required, karena keduanya merupakan data penting untuk identitas anggota.

2. Apa yang akan terjadi jika browser menampilkan Submit pada tombol Simpan tetapi Nama dan No. Anggota kosong?

Karena Nama dan No. Anggota tidak memiliki atribut required, browser tetap mengizinkan form untuk dikirim meskipun kedua field tersebut kosong.

Browser hanya akan memberikan peringatan untuk field yang memiliki required, seperti Alamat dan No. HP, apabila field tersebut belum diisi.

3. Form ini juga belum punya action pada tag <form>—apa dampaknya saat tombol Simpan ditekan?

Jika tag <form> tidak memiliki atribut action, data form akan dikirim ke URL halaman saat ini secara default. Karena belum ada program backend yang memproses data tersebut, data yang dikirim belum tersimpan ke database atau diproses secara nyata.
