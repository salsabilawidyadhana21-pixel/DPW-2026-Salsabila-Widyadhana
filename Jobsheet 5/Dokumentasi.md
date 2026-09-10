# Dokumentasi Jobsheet 5 — JavaScript & Interaktivitas

## 1. Judul

**Jobsheet 5 — JavaScript & Interaktivitas**

## 2. Sub-CPMK

Mampu menambahkan interaktivitas pada halaman web menggunakan JavaScript.

## 3. Tujuan

Jobsheet 5 bertujuan untuk memahami penggunaan JavaScript pada halaman web serta menghubungkan JavaScript dengan elemen HTML melalui DOM (Document Object Model).

Pada jobsheet ini, website SIMPUS-Mini dikembangkan dari Jobsheet 4 dengan menambahkan beberapa fitur interaktif menggunakan JavaScript.

## 4. Struktur Folder

Struktur folder Jobsheet 5 adalah sebagai berikut:

```text
jobsheet-05/
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── app.js
├── buku/
│   ├── list.html
│   └── tambah.html
├── anggota/
│   ├── list.html
│   └── tambah.html
├── index.html
└── docs/
    └── dokumentasi.md
```

## Perubahan dari Jobsheet 4

Pada Jobsheet 5 terdapat beberapa perubahan dan penambahan fitur, yaitu:

Menambahkan file assets/js/app.js.
Menambahkan hamburger menu menggunakan JavaScript.
Menambahkan validasi form.
Menambahkan fitur pencarian/filter pada tabel.
Menambahkan konfirmasi sebelum menghapus data.
JavaScript digunakan untuk memanipulasi elemen HTML secara langsung.

## JavaScript pada SIMPUS-Mini

File utama JavaScript berada di:

```
assets/js/app.js
```
File tersebut berfungsi mengatur interaktivitas pada halaman SIMPUS-Mini.

JavaScript dijalankan setelah halaman HTML selesai dimuat sehingga elemen-elemen HTML dapat ditemukan dan digunakan oleh program.

## Fitur Hamburger Menu

Pada Jobsheet 3, hamburger menu dibuat menggunakan teknik checkbox hack dengan CSS.

Pada Jobsheet 5, teknik tersebut diganti dengan JavaScript.

JavaScript digunakan untuk memberikan atau menghapus class tertentu pada elemen navigasi.

Secara sederhana alurnya adalah:

```
Pengguna menekan tombol hamburger
              ↓
JavaScript menerima event klik
              ↓
Class pada navbar diubah
              ↓
Navbar ditampilkan/disembunyikan
```

Dengan fitur ini, menu navigasi dapat digunakan dengan lebih interaktif pada ukuran layar kecil.

## Validasi Form

JavaScript digunakan untuk melakukan validasi pada form.

Validasi bertujuan untuk memastikan data yang dimasukkan pengguna memenuhi aturan yang telah ditentukan sebelum form diproses.

Contohnya pada form tambah buku dan tambah anggota.

Alur validasi:
```
Pengguna mengisi form
        ↓
Pengguna menekan tombol Simpan
        ↓
JavaScript memeriksa data
        ↓
Data valid?
   ↓            ↓
 Ya            Tidak
 ↓               ↓
Form dapat       Pesan kesalahan
diproses         ditampilkan
```
Validasi dilakukan menggunakan event pada form sehingga JavaScript dapat memeriksa input sebelum proses submit dilanjutkan.

## Fitur Filter/Pencarian Tabel

Jobsheet 5 juga menambahkan fitur pencarian pada tabel.

Fitur ini memungkinkan pengguna mencari data yang terdapat pada tabel berdasarkan teks yang dimasukkan.

Alurnya:
```
Pengguna mengetik kata pencarian
              ↓
JavaScript membaca input
              ↓
Data setiap baris tabel diperiksa
              ↓
Baris yang sesuai tetap ditampilkan
              ↓
Baris yang tidak sesuai disembunyikan
```
Fitur ini membuat pengguna lebih mudah menemukan data buku atau anggota tanpa harus membaca seluruh isi tabel.

## Konfirmasi Hapus Data

Pada tabel terdapat tombol Hapus.

JavaScript digunakan untuk memberikan konfirmasi sebelum data dihapus.

Alurnya:
```
Pengguna menekan tombol Hapus
              ↓
Muncul konfirmasi
              ↓
       Pengguna memilih
        ↙             ↘
      Batal           OK
        ↓              ↓
Data tetap        Baris data
ditampilkan       dihapus
```
Fitur ini digunakan untuk mengurangi kemungkinan data terhapus secara tidak sengaja.

Penghapusan pada Jobsheet 5 dilakukan pada tampilan tabel menggunakan JavaScript dan DOM.

## DOM (Document Object Model)

DOM merupakan mekanisme yang memungkinkan JavaScript mengakses dan memanipulasi elemen HTML.

Pada Jobsheet 5, DOM digunakan untuk:

Mengambil elemen HTML.
Menambahkan event listener.
Mengubah class pada elemen.
Membaca nilai input.
Memeriksa isi tabel.
Menampilkan atau menyembunyikan baris tabel.
Menghapus baris tabel setelah konfirmasi.

Contoh konsep penggunaan DOM:
```
HTML
 ↓
DOM
 ↓
JavaScript
 ↓
Perubahan tampilan halaman
```
Dengan DOM, halaman web dapat memberikan respons terhadap tindakan pengguna tanpa harus memuat ulang seluruh halaman.

## Event pada JavaScript

Interaktivitas pada Jobsheet 5 menggunakan event.

Beberapa event yang digunakan antara lain:
```
click untuk mendeteksi tombol yang ditekan.
submit untuk mendeteksi pengiriman form.
input untuk mendeteksi perubahan pada input pencarian.
```
Event listener digunakan agar JavaScript dapat menjalankan fungsi tertentu ketika pengguna melakukan suatu tindakan.

## Pengujian

Pengujian dilakukan dengan membuka halaman SIMPUS-Mini melalui browser.

## Pengujian Hamburger Menu
Buka website pada ukuran layar kecil.
Tekan tombol hamburger.
Periksa apakah menu navigasi muncul.
Tekan kembali tombol hamburger.
Periksa apakah menu kembali disembunyikan.

Hasil: Hamburger menu dapat digunakan untuk menampilkan dan menyembunyikan navigasi.

## Pengujian Validasi Form
Buka halaman Tambah Buku atau Tambah Anggota.
Kosongkan field yang harus diisi.
Tekan tombol Simpan.
Periksa pesan validasi.
Masukkan data yang sesuai.
Tekan kembali tombol Simpan.

Hasil: Form melakukan pemeriksaan terhadap data sebelum proses submit.

## Pengujian Filter Tabel
Buka halaman Daftar Buku atau Daftar Anggota.
Masukkan kata pada kolom pencarian.
Periksa perubahan data pada tabel.

Hasil: Baris tabel yang sesuai dengan kata pencarian ditampilkan, sedangkan baris yang tidak sesuai disembunyikan.

## Pengujian Tombol Hapus
Buka halaman yang memiliki tabel data.
Tekan tombol Hapus.
Periksa pesan konfirmasi.
Pilih Batal untuk membatalkan.
Ulangi dan pilih OK.

Hasil: Data hanya dihapus dari tampilan tabel setelah pengguna memberikan konfirmasi.

## Kesimpulan

Pada Jobsheet 5, website SIMPUS-Mini dikembangkan dengan menambahkan JavaScript untuk memberikan interaktivitas pada halaman web.

JavaScript digunakan untuk membuat hamburger menu, melakukan validasi form, melakukan pencarian pada tabel, serta memberikan konfirmasi sebelum menghapus data.

Melalui jobsheet ini, dapat dipahami bahwa JavaScript dapat bekerja bersama HTML dan CSS untuk membuat halaman web menjadi lebih interaktif dan responsif terhadap tindakan pengguna.
