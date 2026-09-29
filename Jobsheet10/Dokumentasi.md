# Dokumentasi Jobsheet 10

## 1. Deskripsi

Jobsheet 10 merupakan pengembangan dari **Jobsheet 9** dengan menambahkan **autentikasi dan manajemen session**.

Tujuannya adalah membatasi akses pengguna terhadap halaman pengelolaan data.

## 2. Register

Halaman **Register** digunakan untuk membuat akun pengguna baru.

### Data yang digunakan:

- Nama
- Username
- Password
- Role

### URL:

```text
http://localhost/Jobsheet10/auth/register.php
```
## 3. Login

- Halaman Login digunakan untuk melakukan autentikasi pengguna.

- Pengguna memasukkan username dan password yang telah terdaftar.

### URL:
```
http://localhost/Jobsheet10/auth/login.php
```
Jika data login sesuai, sistem membuat session pengguna.

## 4. Session

- Session digunakan untuk menyimpan informasi pengguna yang sedang login.

- Session juga digunakan untuk mengetahui apakah pengguna sudah melakukan login sebelum mengakses halaman tertentu.

## 5. Role

### Sistem memiliki dua role pengguna:

- Admin

Admin memiliki akses sebagai pengguna dengan role administrator.

- Petugas

Petugas digunakan untuk mengelola data perpustakaan.

- Pembatasan akses dilakukan menggunakan fungsi:
```
require_role(['admin', 'petugas']);
```

## 6. Logout

- Logout digunakan untuk mengakhiri session pengguna.

- Setelah logout, pengguna harus melakukan login kembali untuk mengakses halaman yang membutuhkan autentikasi.

## 7. Alur Sistem
```
Pengguna
   ↓
Register
   ↓
Login
   ↓
Validasi akun
   ↓
Session dibuat
   ↓
Dashboard / halaman utama
   ↓
Akses sesuai role
   ↓
Logout
   ↓
Session berakhir
```
