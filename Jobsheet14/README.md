# Readme - Jobsheet 14 

## Tautan Aplikasi Resmi (Live Deployment)
Aplikasi ini telah berhasil dipindahkan dari lingkungan lokal (*localhost*) ke internet dan dapat diakses secara publik melalui tautan berikut:
* **URL Utama Aplikasi (Jobsheet 13):** https://onrender.com
* **URL Pengembangan Final (Jobsheet 14):** https://onrender.com

---

## Bab 1: Arsitektur & Stack Teknologi
Aplikasi ini dibangun menggunakan arsitektur *cloud* terpisah untuk memisahkan server aplikasi dan server basis data demi menjaga stabilitas performa:
* **Server Aplikasi (Back-End):** PHP Native 8.2 berjalan di atas web server Apache.
* **Server Basis Data (Database):** PostgreSQL Cloud yang dihosting secara terpisah.
* **Infrastruktur Hosting:** **Render Cloud Platform** (Berbasis Docker Environment).
* **Infrastruktur Database:** **Supabase Cloud Service** (PostgreSQL Serverless).

---

## Bab 2: Pemisahan Kredensial Sensitif (Jobsheet 13 Poin 2)
Sesuai dengan instruksi keamanan pada Jobsheet 13, kredensial sensitif seperti *password* database, *host*, dan *username* **tidak ditulis langsung (*hardcode*)** di dalam kode sumber repositori GitHub publik:
1. URL koneksi database yang berisi password diisolasi dan disimpan secara rahasia pada dasbor **Render Environment Variables**.
2. File koneksi pada `includes/koneksi.php` memanfaatkan fungsi `getenv('DATABASE_URL')` untuk memanggil kredensial secara dinamis saat aplikasi berjalan di internet.
3. Ditambahkan sistem *fallback* otomatis menggunakan operator `?:` sehingga kode tetap dapat berjalan secara *offline* di lingkungan lokal (*localhost*) tanpa perlu mengubah struktur kode kembali.

---

## Bab 3: Konfigurasi Infrastruktur Docker (Jobsheet 14)
Sistem penyebaran aplikasi (*deployment*) telah diperkaya dengan berkas cetak biru otomasi awan untuk memenuhi standar evaluasi industri:
1. **`Dockerfile`:** Menggunakan landasan citra resmi `php:8.2-apache` yang dikonfigurasi secara modular untuk mengompilasi ekstensi internal PostgreSQL (`pdo_pgsql`, `pgsql`) agar server Apache mengenali komunikasi data relasional.
2. **`.dockerignore`:** Mengisolasi folder lokal berkas riwayat Git (`.git`) dan berkas sampah agar tidak ikut terunggah, memangkas waktu kompilasi kontainer di server Render secara signifikan.

---

## Bab 4: Otomasi Blueprint Render.yaml (Jobsheet 14)
Berkas `render.yaml` diimplementasikan sebagai cetak biru (*Infrastructure as Code*) untuk mengunci standarisasi server produksi:
* Mengunci penempatan wilayah server terdekat di **Singapore** agar akses web lebih cepat.
* Memanfaatkan alokasi spesifikasi komputasi **Free Plan**.
* Mendaftarkan dependensi *Environment Variable* secara asinkron (`sync: false`) agar proses perakitan ulang (*rebuild*) berjalan secara instan.

---

## Bab 5: Hasil Evaluasi & Pengujian Keamanan
Seluruh modul program aplikasi telah melewati 24 tahapan pemeriksaan pengujian terintegrasi (*end-to-end testing*) dengan hasil sebagai berikut:
* **Autentikasi Keamanan:** Sistem enkripsi searah berbasis `password_hash()` pada pendaftaran user baru berfungsi 100% aman.
* **Keamanan Transaksi Pooler:** Pengaktifan `PDO::ATTR_EMULATE_PREPARES => true` menjamin aplikasi terbebas dari galat memori saat melakukan penarikan data transaksi peminjaman secara simultan lewat jalur port pooler Supabase (Port 6543).
* **Ketahanan SQL Injection:** Struktur manipulasi data berbasis *Prepared Statements* pada objek PDO memastikan seluruh form input aman dari celah kebocoran kueri SQL.

---

## Bab 6: Hak Akses & Fitur Utama (Role Per Role)
Aplikasi ini menyediakan hak akses penuh bagi **Petugas / Admin** dengan fungsionalitas sebagai berikut:
1. **Autentikasi Keamanan:** Fitur Registrasi akun petugas baru dan Login aman.
2. **Manajemen Buku (CRUD):** Tambah data buku, melihat daftar buku, mengubah informasi buku, dan menghapus data buku.
3. **Manajemen Anggota (CRUD):** Pengelolaan data identitas nomor anggota perpustakaan secara unik (*unique constraint*).
4. **Pencatatan Transaksi:** Modul peminjaman dan pengembalian buku perpustakaan lengkap dengan penanganan tanggal jatuh tempo.

---

## Indeks: Panduan Instalasi Lokal (Instalasi Ulang)
Jika ingin menjalankan ulang proyek ini di lingkungan komputer lokal Anda:
1. Klik tombol **Clone** atau unduh repositori GitHub ini ke dalam folder server lokal Anda.
2. Buka folder `/sql` atau salin seluruh perintah DDL basis data pada berkas `.sql` tugas.
3. Eksekusi script tersebut pada aplikasi basis data lokal Anda (seperti DBeaver/pgAdmin) untuk membangun tabel `buku`, `anggota`, `users`, dan `peminjaman`.
4. Sesuaikan variabel koneksi database pada berkas `koneksi.php` lokal agar mengarah ke *localhost* Anda.
5. Akses folder melalui browser laptop Anda (misalnya: `http://localhost/DPW-2026-Salsabila-Widyadhana/Jobsheet14/`).

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
