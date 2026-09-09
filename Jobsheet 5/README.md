# Jobsheet 5 — JavaScript & Interaktivitas

Sub-CPMK: Menambahkan interaktivitas pada halaman web menggunakan JavaScript.

## Perubahan dari Jobsheet 4

Pada Jobsheet 5 dilakukan penambahan JavaScript untuk membuat website SIMPUS-Mini menjadi lebih interaktif.

Perubahan yang dilakukan:

- Menambahkan file `assets/js/app.js`.
- Mengubah hamburger menu menjadi menggunakan JavaScript.
- Menambahkan validasi pada form.
- Menambahkan fitur pencarian/filter pada tabel.
- Menambahkan konfirmasi sebelum menghapus data.
- Menggunakan DOM untuk mengakses dan memanipulasi elemen HTML.

## Fitur
#### 1. Hamburger Menu

Menu navigasi pada ukuran layar kecil dapat dibuka dan ditutup menggunakan tombol hamburger.

Pada Jobsheet 5, pengaturan menu dilakukan menggunakan JavaScript melalui event klik.

#### 2. Validasi Form

JavaScript digunakan untuk melakukan validasi pada form tambah buku dan tambah anggota.

Validasi digunakan untuk memastikan input yang diperlukan telah diisi sebelum form diproses.

#### 3. Filter Tabel

Ditambahkan fitur pencarian pada tabel data buku dan anggota.

Pengguna dapat memasukkan kata pencarian untuk menampilkan data yang sesuai.

#### 4. Konfirmasi Hapus

Tombol Hapus diberikan konfirmasi menggunakan JavaScript.

Data tidak langsung dihapus ketika tombol ditekan. Pengguna terlebih dahulu diminta melakukan konfirmasi.

Jika pengguna membatalkan, data tetap ditampilkan.

Jika pengguna menyetujui, baris data akan dihapus dari tabel.

####  JavaScript

File JavaScript utama berada pada:
```
assets/js/app.js
```
File tersebut digunakan untuk mengatur seluruh interaktivitas pada halaman SIMPUS-Mini.

JavaScript berinteraksi dengan elemen HTML menggunakan DOM sehingga halaman dapat memberikan respons terhadap tindakan pengguna.

## Kesimpulan

Pada Jobsheet 5, website SIMPUS-Mini dikembangkan dengan menambahkan JavaScript sebagai teknologi untuk memberikan interaktivitas.

Fitur yang berhasil diterapkan meliputi hamburger menu, validasi form, filter tabel, dan konfirmasi penghapusan data.

Dengan penerapan JavaScript dan DOM, website menjadi lebih interaktif dan dapat memberikan respons terhadap tindakan pengguna.

## Struktur Folder

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
├── docs/
│   └── dokumentasi.md
└── index.html
