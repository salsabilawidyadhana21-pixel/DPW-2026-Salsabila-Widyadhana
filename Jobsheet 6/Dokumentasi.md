# Dokumentasi Jobsheet 6 — Fetch API dan JSON

## 1. Identitas

**Mata Kuliah:** Pemrograman Web  
**Jobsheet:** 6  
**Materi:** Fetch API dan JSON  
**Nama:** Salsabila Widyadhana  

---

## 2. Tujuan Praktikum

Jobsheet 6 bertujuan untuk memahami dan menerapkan komunikasi asinkron menggunakan Fetch API dan JSON pada website SIMPUS-Mini.

Pada jobsheet ini data buku dan anggota tidak lagi ditulis langsung pada tabel HTML, tetapi disimpan dalam file JSON kemudian dimuat menggunakan JavaScript.

---

## 3. Perubahan dari Jobsheet 5

Pada Jobsheet 6 terdapat beberapa perubahan dari Jobsheet 5, yaitu:

1. Menambahkan folder `data` untuk menyimpan data dalam format JSON.
2. Menambahkan file `data/buku.json`.
3. Menambahkan file `data/anggota.json`.
4. Menambahkan `assets/js/buku.js` untuk mengambil dan menampilkan data buku.
5. Menambahkan `assets/js/anggota.js` untuk mengambil dan menampilkan data anggota.
6. Data pada tabel buku dan anggota dibuat secara dinamis menggunakan JavaScript.
7. Menambahkan loading indicator saat data sedang dimuat.
8. Menambahkan penanganan error menggunakan `try...catch`.
9. Menggunakan `async/await` dalam proses pengambilan data.
10. Mengubah fungsi tombol Hapus menjadi event delegation karena tombol dibuat secara dinamis oleh JavaScript.

---

# 4. Struktur Folder

Struktur folder Jobsheet 6 adalah sebagai berikut:

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

## 5. Hasil Praktikum

Hasil dari Jobsheet 6 adalah website SIMPUS-Mini yang mampu mengambil data dari file JSON menggunakan Fetch API.

Data buku dan anggota tidak lagi ditulis secara langsung pada HTML, tetapi dibuat secara dinamis menggunakan JavaScript.

Fitur yang berhasil diterapkan:
```
Fetch API
JSON
Async/await
Dynamic rendering
Loading indicator
Error handling
Event delegation
Pencarian data
Hapus data secara dinamis
```

## 6. Kesimpulan

Pada Jobsheet 6 telah dipelajari penerapan komunikasi asynchronous menggunakan Fetch API dan JSON.

Data yang sebelumnya ditulis langsung pada HTML sekarang dapat disimpan dalam file JSON dan diambil menggunakan JavaScript. Data tersebut kemudian ditampilkan secara dinamis ke dalam tabel.

Penggunaan async/await membuat proses pengambilan data lebih mudah dipahami. Selain itu, loading indicator dan try...catch digunakan agar proses pengambilan data dapat memberikan informasi kepada pengguna ketika sedang berlangsung maupun ketika terjadi kesalahan.

Konsep yang dipelajari pada Jobsheet 6 menjadi dasar untuk pengembangan aplikasi dengan data dari server atau API pada tahap berikutnya.
