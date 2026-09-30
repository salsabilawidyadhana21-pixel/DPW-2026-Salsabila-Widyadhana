# Dokumentasi Jobsheet 11

## Keamanan Aplikasi SIMPUS Mini

### 1. Tujuan

Jobsheet 11 bertujuan untuk meningkatkan keamanan aplikasi SIMPUS Mini dengan menerapkan validasi input, keamanan query database, autentikasi, manajemen sesi, dan pembatasan hak akses.

### 2. Implementasi Keamanan

#### A. Prepared Statements

Prepared statements digunakan untuk memisahkan query SQL dari input pengguna sehingga mengurangi risiko SQL Injection.

#### B. Cross-Site Scripting (XSS)

Output dari input pengguna di-escape sebelum ditampilkan pada halaman agar kode HTML atau JavaScript tidak dijalankan sebagai script.

#### C. Cross-Site Request Forgery (CSRF)

CSRF token digunakan pada form yang melakukan perubahan data untuk memvalidasi bahwa permintaan berasal dari sesi aplikasi yang sah.

#### D. Validasi Input

Sistem melakukan pemeriksaan terhadap input pengguna, seperti panjang karakter, format, dan nilai yang diperbolehkan sebelum data diproses.

#### E. Password Hashing

Password pengguna disimpan dalam bentuk hash dan diperiksa menggunakan fungsi verifikasi password agar password asli tidak disimpan dalam database.

#### F. Manajemen Sesi

Sesi diperbarui setelah autentikasi untuk mengurangi risiko penyalahgunaan session ID.

#### G. Role-Based Access Control

Hak akses dibatasi berdasarkan role pengguna, yaitu admin dan petugas. Beberapa fitur administratif, seperti penghapusan anggota, dibatasi untuk admin.

### 3. Alur Keamanan

1. Pengguna membuka halaman login.
2. Pengguna memasukkan username dan password.
3. Sistem memvalidasi input dan mencari akun menggunakan prepared statements.
4. Sistem memverifikasi password dengan hash yang tersimpan.
5. Jika berhasil, sistem membuat atau memperbarui sesi pengguna.
6. Sistem memeriksa autentikasi dan role sebelum mengizinkan akses ke fitur.
7. Setiap permintaan perubahan data menjalani validasi dan pemeriksaan CSRF token.

### 4. Pengujian

Pengujian yang telah dilakukan:

* Percobaan SQL Injection pada login tidak berhasil melewati autentikasi.
* Input berupa script ditampilkan sebagai teks.
* Pendaftaran menggunakan password minimal 8 karakter berhasil.
* Validasi stok negatif diuji melalui batas input pada form.

### 5. Kesimpulan

Penerapan keamanan pada Jobsheet 11 membantu melindungi aplikasi SIMPUS Mini dari input berbahaya, penyalahgunaan autentikasi, dan akses yang tidak sesuai dengan hak pengguna. Keamanan diterapkan pada sisi aplikasi maupun saat berinteraksi dengan database.
