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

## Screenshoot Alur Utama
<img width="640" height="331" alt="image" src="https://github.com/user-attachments/assets/6e89da79-6b5a-48ea-9564-b44a6ffa051a" />

<img width="637" height="353" alt="image" src="https://github.com/user-attachments/assets/64f63493-5521-4ada-ac7e-86d9943de2bf" />

<img width="638" height="335" alt="image" src="https://github.com/user-attachments/assets/fa6c930c-e4f4-4226-8c8c-f5798a34e56a" />

<img width="478" height="260" alt="image" src="https://github.com/user-attachments/assets/35e3815e-f482-47ce-a7a5-3772826528b0" />

<img width="488" height="96" alt="image" src="https://github.com/user-attachments/assets/f7d8de1b-96e2-4292-b99b-2d2e78246b7d" />

<img width="640" height="334" alt="image" src="https://github.com/user-attachments/assets/6d2a0583-d960-40be-a2a6-104a71254805" />

<img width="478" height="317" alt="image" src="https://github.com/user-attachments/assets/310e9c1e-0f93-4997-8e9a-7415b253ef38" />

<img width="477" height="76" alt="image" src="https://github.com/user-attachments/assets/8d661070-f8c8-4c5e-869a-cbc3e495982f" />

<img width="640" height="331" alt="image" src="https://github.com/user-attachments/assets/9bc48ea0-c749-4770-95e1-9da80523ae45" />

<img width="476" height="335" alt="image" src="https://github.com/user-attachments/assets/1f0d1aad-8fe5-4854-b4d8-043641c04a1e" />

## Fitur Utama yang Ditambahkan

1. **Kolom Status pada Database**:
   - Menambahkan kolom `status` pada tabel buku untuk mengontrol ketersediaan data secara *soft delete* (tanpa harus menghapus baris data secara permanen dari database).

2. **Logika Toggle Status (`toggle_status.php`)**:
   - Berkas skrip backend baru yang menangani proses pembalikan status (mengubah status Aktif menjadi Nonaktif, dan sebaliknya) saat tombol aksi diklik oleh pengguna.

3. **Pembaruan Halaman Daftar Buku (`buku/list.php`)**:
   - Menyesuaikan tampilan antarmuka (UI) pada tabel daftar buku.
   - Menyertakan tombol interaktif untuk melakukan *toggle* status secara langsung dari halaman daftar.

## Teknologi yang Digunakan
- **PHP** (Native)
- **PostgreSQL** (Database Cloud via Supabase)
- **HTML/CSS & Bootstrap** (Antarmuka Pengguna)
- **Git & GitHub** (Kontrol Versi)
- **Render** (Deployment Aplikasi Web)
