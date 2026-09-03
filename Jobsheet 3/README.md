# SIMUS Mini - Sistem Informasi Perpustakaan Sederhana

Proyek ini adalah aplikasi web sederhana bernama **SIMUS Mini** yang dikembangkan untuk mengelola data buku dan anggota perpustakaan. Repositori ini berfokus pada penerapan **Jobsheet 3**, yaitu implementasi desain tampilan yang **responsif** menggunakan CSS Flexbox, CSS Grid, dan Media Queries agar optimal diakses melalui perangkat desktop, tablet, maupun mobile.

---

## Struktur Folder

```
Jobsheet 3/
│
├── index.html               # Halaman Beranda / Dashboard
├── assets/
│   └── css/
│       └── style.css        # Berkas lembar gaya utama & aturan responsive
├── buku/
│   ├── list.html            # Halaman Daftar Buku (dilengkapi tabel responsif)
│   └── tambah.html          # Halaman Form Tambah Buku
└── anggota/
    ├── list.html            # Halaman Daftar Anggota
    └── tambah.html          # Halaman Form Tambah Anggota
```

## Fitur Utama (Jobsheet 3)
1. Navigasi Responsif & Hamburger Menu: Menggunakan pendekatan CSS murni (input type="checkbox" dan label) untuk menampilkan menu navigasi secara vertikal pada layar perangkat berukuran kecil.
2. Layout Kartu Fleksibel (CSS Grid): Ringkasan data dan menu utama disusun menggunakan grid yang secara dinamis menyesuaikan kolomnya berdasarkan lebar layar (3 kolom di desktop, 2 kolom di tablet, dan 1 kolom di mobile).
3. Tabel Responsif (.table-responsive): Tabel data buku dan anggota dilengkapi pembungkus dengan properti overflow-x: auto agar dapat digeser horizontal tanpa merusak tata letak layar ponsel.
4. Formulir Adaptif: Elemen input pada halaman tambah data dirancang agar otomatis menyesuaikan lebar kontainer di berbagai ukuran layar.
