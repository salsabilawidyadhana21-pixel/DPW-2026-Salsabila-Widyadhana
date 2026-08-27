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

# 2. Penjelasan index.html (Halaman Beranda)

File index.html merupakan halaman utama dari aplikasi SIMUS Mini. Halaman ini menjadi halaman pertama yang dibuka ketika project dijalankan.

Halaman Beranda berisi:

- Header aplikasi
- Navigasi
- Informasi selamat datang
- Menu utama
- Footer

### Struktur Dasar index.html
```
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIMUS Mini - Beranda</title>
</head>

<body>

    <!-- Isi halaman -->

</body>
</html>
```

### Penjelasan
```
1. <!DOCTYPE html> digunakan untuk menyatakan bahwa dokumen menggunakan HTML5.
2. <html lang="id"> menunjukkan bahwa bahasa utama halaman adalah Bahasa Indonesia.
3. <head> berisi informasi tentang halaman.
4. <meta charset="UTF-8"> digunakan agar karakter dapat ditampilkan dengan benar.
5. <meta name="viewport"> membantu halaman menyesuaikan ukuran layar perangkat.
6. <title> menentukan judul yang muncul pada tab browser.
7. <body> berisi seluruh konten yang ditampilkan pada halaman.
```

### Bagian Header

Header digunakan untuk menampilkan identitas utama dari aplikasi.
```
<header>
    <h1>SIMUS Mini</h1>
    <p>Sistem Informasi Perpustakaan Sederhana</p>
</header>
```
### Penjelasan:
```
1. <header> merupakan tag semantic untuk bagian kepala halaman.
2. <h1> digunakan untuk menampilkan judul utama website.
3. <p> digunakan untuk memberikan deskripsi singkat tentang aplikasi.
```
Pada bagian ini, pengguna dapat mengetahui bahwa website yang dibuat adalah aplikasi SIMUS Mini, yaitu sistem informasi perpustakaan sederhana.

