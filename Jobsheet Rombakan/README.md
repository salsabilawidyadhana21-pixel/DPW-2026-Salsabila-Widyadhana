# Readme - Jobsheet Rombakan (TOKO-Lite)

---

## Arsitektur & Stack Teknologi
Aplikasi ini dibangun menggunakan arsitektur *Front-End Asynchronous Data Rendering* tanpa ketergantungan pada pustaka (*framework*) luar untuk menjaga performa aplikasi tetap cepat dan ringan:
- **Sistem Antarmuka (Front-End):** HTML5 Semantik dan CSS3 Kustom (Menggunakan Variabel CSS & CSS Grid).
- **Bahasa Pemrograman Utama:** Vanilla JavaScript (ES6+) Native.
- **Mekanisme Komunikasi Data:** Fetch API (`async/await`) untuk pengolahan data lokal secara asinkron.
- **Format Pertukaran Data:** JSON (*JavaScript Object Notation*) sebagai basis data lokal terstruktur.

---

## Pemisahan & Isolasi Komponen Kode (Arsitektur JS)
Sesuai dengan prinsip pemisahan tanggung jawab (*Separation of Concerns*), fungsi dan logika program diisolasi secara modular di dalam folder `assets/js/`:
1. File `app.js` berfungsi sebagai pengendali utilitas global yang menangani interaksi navigasi mobile, filter pencarian tabel *real-time*, validasi form, dan *Event Delegation* untuk hapus data.
2. File `produk.js` dan `pelanggan.js` diisolasi khusus untuk menangani *request* Fetch API dan pembentukan elemen DOM tabel secara dinamis.
3. Seluruh file HTML memanggil berkas skrip utama pada bagian akhir tag `<body>` untuk memastikan elemen antarmuka selesai dimuat sebelum skrip dieksekusi.

---

## Desain Visual & Responsivitas Antarmuka (Tema Soft Girlies)
Sistem tampilan aplikasi ini dirombak total dari modul standar praktikum dengan menerapkan konsep visual modern:
1. **Skema Warna Pastel:** Menggunakan palet warna kustom *Soft Girlies Pink* berbasis variabel CSS (`--pink-primary`, `--pink-light`, `--pink-accent`).
2. **Fleksibilitas Layout:** Penggunaan CSS Grid pada halaman utama untuk menyusun kartu ringkasan *dashboard* secara proporsional.
3. **Navigasi Seluler (Mobile Navigation):** Penerapan `@media (max-width: 600px)` dipadukan dengan tombol hamburger interaktif (`#nav-toggle-btn`) untuk kenyamanan akses pada perangkat HP.

---

## Manipulasi DOM & Event Delegation
Sistem pengelolaan data pada tabel memanfaatkan teknik manipulasi DOM tingkat lanjut:
- **Event Delegation (Fitur Hapus):** Event klik didaftarkan pada level `document` untuk mendeteksi penekanan tombol `.btn-hapus` pada baris tabel yang dibuat secara dinamis lewat Fetch API.
- **Filter Pencarian Real-Time:** Memanfaatkan event `keyup` pada input pencarian untuk memeriksa kecocokan teks di setiap baris `<tr>` dan menyembunyikan data yang tidak cocok via `style.display = 'none'`.

---

## Hasil Evaluasi & Pengujian Fitur
Seluruh modul program aplikasi telah melewati tahap pemeriksaan fungsi (*end-to-end testing*) dengan hasil sebagai berikut:
- **Konsistensi Navigasi:** Seluruh 5 halaman utama memiliki struktur menu navigasi yang identik dan saling terhubung tanpa ada tautan rusak (*broken link*).
- **Validasi Form Kustom:** Pengisian form pada `tambah.html` terlindungi dari *submit* kosong dengan memicu pesan peringatan merah interaktif.
- **Ketahanan Rendering Fetch:** Penggunaan blok `try...catch...finally` menjamin indikator *loading* disembunyikan secara otomatis baik saat data berhasil dimuat maupun saat terjadi galat pembacaan file JSON.

---

## Hak Akses & Fitur Utama (Fungsionalitas Sistem)
Aplikasi ini menyediakan antarmuka kelola toko bagi **Pengelola / Admin** dengan fungsionalitas sebagai berikut:
1. **Beranda / Dashboard:** Menampilkan kartu ringkasan total produk, total pelanggan, dan estimasi transaksi harian.
2. **Kelola Data Produk (CRUD Interface):** Menampilkan daftar produk dari JSON secara otomatis, filter pencarian cepat, serta aksi simulasi tambah dan hapus baris produk.
3. **Kelola Data Pelanggan (CRUD Interface):** Menampilkan data pelanggan dari JSON, pencarian nama pelanggan, serta form pendaftaran pelanggan baru.

---

## Indeks: Panduan Instalasi Lokal (Instalasi Ulang)
Jika ingin menjalankan proyek ini di lingkungan komputer lokal Anda:
1. Klik tombol **Clone** atau unduh repositori GitHub ini ke komputer Anda.
2. Buka folder repositori di editor teks **Visual Studio Code**.
3. Pastikan Anda telah menginstal ekstensi **Live Server** di VS Code.
4. Buka direktori `/Jobsheet Rombakan/`, klik kanan pada berkas `index.html`, lalu pilih **Open with Live Server**.
5. Akses aplikasi melalui alamat lokal yang dihasilkan oleh Live Server (misalnya: `http://127.0.0.1:5500/Jobsheet%20Rombakan/index.html`).

## Fitur Utama yang Ditambahkan (Perombakan)
1. **Standardisasi Navigasi Uniform**:
   - Menyeragamkan 5 tautan navigasi di seluruh halaman (`Beranda`, `Daftar Produk`, `Tambah Produk`, `Daftar Pelanggan`, `Tambah Pelanggan`).
2. **Interaktivitas Hamburger Menu (`app.js`)**:
   - Menambahkan event listener tombol toggle untuk memunculkan dan menyembunyikan menu navigasi pada layar seluler.
3. **Pencarian Real-Time Tanpa Reload (`setupSearch`)**:
   - Fungsi pencarian instan yang memfilter konten baris tabel secara dinamis berdasarkan masukan ketikan pengguna.

## Teknologi yang Digunakan
- **HTML5 & CSS3** (Struktur & Visual Antarmuka)
- **Vanilla JavaScript ES6+** (Logika, Fetch API, & DOM Manipulation)
- **JSON** (Basis Data Lokal / Mock Data)
- **Git & GitHub** (Kontrol Versi Repositori)
