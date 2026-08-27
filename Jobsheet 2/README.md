# Dokumentasi Jobsheet 2 — CSS3 Styling Dasar

# 1. Apa itu CSS
CSS (Cascading Style Sheets) adalah bahasa yang digunakan untuk mengatur tampilan halaman web yang dibuat dengan HTML.

Kalau HTML digunakan untuk membuat struktur, CSS digunakan untuk membuat tampilannya.

Contohnya:
```
<h1>SIMUS Mini</h1>
```
Tanpa CSS, tampilannya masih sederhana.

Dengan CSS:
```
h1 {
    color: blue;
    text-align: center;
}
```
Maka judul akan berwarna biru dan berada di tengah.

CSS bisa digunakan untuk mengatur:

- warna
- ukuran dan jenis tulisan
- jarak
- background
- border
- posisi elemen
- tabel
- tombol
- layout menggunakan Flexbox dan Grid

Jadi gampangnya:

HTML = struktur website

CSS = tampilan website

JavaScript = fungsi/interaksi website

# 2. Penjelasan index.html

index.html merupakan halaman utama aplikasi SIMUS Mini. Pada Jobsheet 2, halaman ini mulai diberikan styling menggunakan CSS agar tampil lebih rapi.

File CSS dihubungkan dengan:
```
<link rel="stylesheet" href="assets/css/style.css">
```
Halaman terdiri dari header, navigation, main content, card statistik, dan footer.

# 3. Penjelasan buku/list.html

File ini digunakan untuk menampilkan daftar buku dalam bentuk tabel.

CSS digunakan untuk mengatur ukuran tabel, border, warna header, zebra stripe pada baris tabel, serta efek hover ketika kursor diarahkan ke baris.

# 4. Penjelasan buku/tambah.html

File ini merupakan form untuk menambahkan data buku.

CSS digunakan untuk membuat form lebih rapi, termasuk mengatur input, select, label, textarea, dan tombol.

Field yang tersedia adalah:

Judul, Pengarang, Tahun, ISBN, Stok, Kategori

# 5. Penjelasan anggota/list.html

File ini digunakan untuk menampilkan daftar anggota dalam bentuk tabel.

Tampilan dibuat konsisten dengan tabel Daftar Buku menggunakan CSS yang sama, termasuk border, zebra stripe, dan hover.

# 6. Penjelasan anggota/tambah.html

File ini digunakan untuk membuat form tambah anggota.

Field yang digunakan:

Nama, No. Anggota, Alamat, No. HP

CSS memberikan tampilan yang sama dengan Form Tambah Buku sehingga seluruh halaman terlihat konsisten.

# 7. CSS Flexbox

Flexbox digunakan pada bagian header dan navigation:
```
.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
```
Flexbox membuat logo dan menu dapat tersusun secara rapi dalam satu baris.

# 8. CSS Grid dan Card

CSS Grid digunakan untuk membuat tiga card statistik pada halaman Beranda.
```
.card-container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}
```
Card digunakan untuk menampilkan informasi Total Buku, Total Anggota, dan Total Dipinjam.

# 9. Styling Tabel, Form, dan Button

CSS digunakan untuk memberikan tampilan yang lebih menarik pada tabel, form, dan tombol.

Tabel memiliki zebra stripe dan efek hover, sedangkan form memiliki border, padding, dan efek focus pada input.

Tombol juga diberikan warna dan efek hover.
