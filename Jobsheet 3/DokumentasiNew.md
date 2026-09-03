# Dokumentasi - SIMUS Mini (Jobsheet 3)

Dokumentasi ini menjelaskan secara rinci struktur, komponen, serta implementasi teknis dari **Jobsheet 3: Membuat Tampilan Responsif** pada proyek web **SIMUS Mini**.

---

## 📂 Daftar Halaman & Navigasi
Proyek ini memiliki struktur halaman multi-halaman (*multi-page website*) dengan pembagian direktori sebagai berikut:
1. **Beranda (`index.html`)**
   * Berfungsi sebagai halaman utama/dashboard sistem.
   * Berisi ringkasan statistik data (Total Buku, Total Anggota, dan Total Buku Dipinjam) serta kartu navigasi cepat ke menu utama.
2. **Daftar Buku (`buku/list.html`)**
   * Menampilkan tabel data buku lengkap dengan informasi nomor, judul, pengarang, tahun, stok, dan tombol aksi (Edit/Hapus).
3. **Tambah Buku (`buku/tambah.html`)**
   * Menyediakan form input data buku baru mencakup judul, pengarang, tahun terbit, ISBN, stok, dan pilihan kategori.
4. **Daftar Anggota (`anggota/list.html`)**
   * Menampilkan tabel daftar anggota perpustakaan (Nama, Nomor Anggota, Alamat, Nomor HP, dan aksi Edit/Hapus).
5. **Tambah Anggota (`anggota/tambah.html`)**
   * Berisi form registrasi anggota baru yang dilengkapi elemen input teks, textarea untuk alamat, dan nomor telepon.

---

## 📱 Implementasi Desain Responsif (Jobsheet 3)

Seluruh aturan tampilan responsif dikontrol melalui file `assets/css/style.css` menggunakan teknik *CSS Media Queries*, *Flexbox*, dan *CSS Grid*.

### 1. Pengaturan Dasar & Pencegahan Overflow
* Properti `box-sizing: border-box` diterapkan secara global untuk memudahkan pengaturan ukuran elemen.
* Menggunakan `overflow-x: hidden` pada elemen `body` guna mencegah halaman bergeser atau melebar ke samping secara tidak sengaja pada layar kecil.

### 2. Navigasi & Hamburger Menu (Mobile & Tablet)
* Pada layar desktop, menu navigasi berbaris horizontal secara fleksibel (`flex`).
* Pada layar dengan lebar <= 768px:
  * Tombol navigasi standar disembunyikan dan digantikan dengan ikon hamburger (`☰`) dari elemen `<label>`.
  * Memanfaatkan elemen tersembunyi `<input type="checkbox" id="menu-toggle">` yang dikombinasikan dengan selektor `:checked ~ nav` untuk memunculkan menu secara vertikal saat ikon hamburger diklik.

### 3. Layout Grid yang Fleksibel (`.card-container`)
Tata letak elemen berbasis kartu (*card*) menyesuaikan jumlah kolom secara otomatis berdasarkan *breakpoint* layar:
* **Desktop (>= 1024px)**: Menggunakan 3 kolom (`repeat(3, 1fr)`).
* **Tablet (<= 768px)**: Menyesuaikan menjadi 2 kolom (`repeat(2, 1fr)`).
* **Mobile (<= 480px)**: Menyusut menjadi 1 kolom penuh (`1fr`), serta membuat tombol aksi menjadi *full-width* (`width: 100%`) agar mudah disentuh.

### 4. Tabel Responsif (`.table-responsive`)
* Elemen `<table>` dibungkus di dalam kontainer `.table-responsive` dengan properti `overflow-x: auto`.
* Tabel diberi batas minimum lebar (`min-width: 650px`) sehingga struktur kolom di dalam tabel tidak rusak atau tertekan saat dibuka melalui perangkat seluler, melainkan bisa digeser secara horizontal.
