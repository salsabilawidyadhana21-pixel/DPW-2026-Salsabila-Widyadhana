# Jobsheet 13

## Tautan Aplikasi Resmi (Live Deployment)
Aplikasi ini telah berhasil dipindahkan dari lingkungan lokal (*localhost*) ke internet dan dapat diakses secara publik melalui tautan berikut:
* **URL Utama Aplikasi:** https://dpw-2026-salsabila-widyadhana.onrender.com/Jobsheet13/auth/login.php

---

## Arsitektur & Stack Teknologi
Aplikasi ini dibangun menggunakan arsitektur *cloud* terpisah untuk memisahkan server aplikasi dan server basis data demi menjaga stabilitas performa:
* **Server Aplikasi (Back-End):** PHP Native 8.2 berjalan di atas web server Apache.
* **Server Basis Data (Database):** PostgreSQL Cloud yang dihosting secara terpisah.
* **Infrastruktur Hosting:** **Render Cloud Platform** (Berbasis Docker Environment).
* **Infrastruktur Database:** **Supabase Cloud Service** (PostgreSQL Serverless).

---

## Pemisahan Kredensial Sensitif (Jobsheet 13 Poin 2)
Sesuai dengan instruksi keamanan pada Jobsheet 13, kredensial sensitif seperti *password* database, *host*, dan *username* **tidak ditulis langsung (*hardcode*)** di dalam kode sumber repositori GitHub publik. 

Sistem keamanan diimplementasikan menggunakan **Environment Variables** dengan mekanisme sebagai berikut:
1. URL koneksi database yang berisi password diisolasi dan disimpan secara rahasia pada dasbor **Render Environment**.
2. File koneksi pada `includes/koneksi.php` memanfaatkan fungsi `getenv('DATABASE_URL')` untuk memanggil kredensial secara dinamis saat aplikasi berjalan di internet.
3. Ditambahkan sistem *fallback* otomatis menggunakan operator `?:` sehingga kode tetap dapat berjalan secara *offline* di lingkungan lokal (*localhost*) tanpa perlu mengubah struktur kode kembali.

---

## Hak Akses & Fitur Utama (Role Per Role)
Aplikasi ini menyediakan hak akses penuh bagi **Petugas / Admin** dengan fungsionalitas sebagai berikut:
1. **Autentikasi Keamanan:** Fitur Registrasi akun petugas baru dan Login aman.
2. **Manajemen Buku (CRUD):** Tambah data buku, melihat daftar buku, mengubah informasi buku, dan menghapus data buku.
3. **Manajemen Anggota (CRUD):** Pengelolaan data identitas nomor anggota perpustakaan secara unik (*unique constraint*).
4. **Pencatatan Transaksi:** Modul peminjaman dan pengembalian buku perpustakaan.

---

## Panduan Instalasi Lokal (Instalasi Ulang)
Jika ingin menjalankan ulang proyek ini di lingkungan komputer lokal Anda:
1. Klik tombol **Clone** atau unduh repositori GitHub ini ke dalam folder server lokal Anda.
2. Buka folder `/sql` atau salin seluruh perintah DDL basis data pada berkas `.sql` tugas.
3. Eksekusi script tersebut pada aplikasi basis data lokal Anda (seperti DBeaver/pgAdmin) untuk membangun tabel `buku`, `anggota`, dan `users`.
4. Sesuaikan variabel koneksi database pada berkas `koneksi.php` lokal agar mengarah ke *localhost* Anda.
5. Akses folder melalui browser laptop Anda (misalnya: `http://localhost/DPW-2026-Salsabila-Widyadhana/Jobsheet13/`).
