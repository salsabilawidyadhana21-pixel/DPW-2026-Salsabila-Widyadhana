# Jobsheet 6 — Fetch API & JSON

Sub-CPMK: Menerapkan komunikasi asinkron (AJAX/fetch, JSON).

## Perubahan dari Jobsheet 5

Pada Jobsheet 6, aplikasi SIMPUS-Mini dikembangkan dengan menerapkan Fetch API dan JSON untuk menampilkan data secara dinamis.

Perubahan yang dilakukan:

- Menambahkan folder `data/` untuk menyimpan data dalam format JSON.
- Menambahkan `data/buku.json` yang berisi 10 data buku.
- Menambahkan `data/anggota.json` yang berisi data anggota.
- Menambahkan `assets/js/buku.js` untuk mengambil dan menampilkan data buku menggunakan Fetch API.
- Menambahkan `assets/js/anggota.js` untuk mengambil dan menampilkan data anggota menggunakan Fetch API.
- Isi `<tbody>` pada halaman daftar buku dan daftar anggota dikosongkan karena data akan dibuat secara dinamis menggunakan JavaScript.
- Menambahkan loading indicator dengan tulisan `Memuat data...` selama proses pengambilan data.
- Menambahkan simulasi delay jaringan menggunakan `setTimeout`.
- Menambahkan error handling menggunakan `try...catch`.
- Menggunakan `async/await` dalam proses pengambilan data JSON.
- Mengubah fungsi tombol Hapus menjadi event delegation karena tombol dibuat secara dinamis setelah data JSON berhasil dimuat.
- Fitur pencarian data tetap digunakan untuk memfilter data yang sudah ditampilkan pada tabel.

## Teknologi yang Digunakan

- HTML5
- CSS3
- JavaScript
- Fetch API
- JSON
- Async/Await
- Live Server

## Struktur Folder

```text
Jobsheet 6/
├── anggota/
│   ├── list.html
│   └── tambah.html
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── anggota.js
│       ├── app.js
│       └── buku.js
├── buku/
│   ├── list.html
│   └── tambah.html
├── data/
│   ├── anggota.json
│   └── buku.json
├── docs/
│   └── wireframe.md
├── Dokumentasi.md
├── README.md
└── index.html
```
