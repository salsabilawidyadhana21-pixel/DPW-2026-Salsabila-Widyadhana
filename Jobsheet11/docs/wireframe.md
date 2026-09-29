# Wireframe Jobsheet 11

## SIMPUS Mini

Wireframe ini menggambarkan rancangan sederhana halaman utama aplikasi SIMPUS Mini.

### 1. Halaman Login

```text
+--------------------------------------------------+
|                   SIMPUS MINI                    |
|           Sistem Informasi Perpustakaan          |
|                                                  |
|  Username: [________________________]            |
|                                                  |
|  Password: [________________________]            |
|                                                  |
|               [      Login      ]                |
|                                                  |
+--------------------------------------------------+
```

### 2. Halaman Dashboard

```text
+--------------------------------------------------------------+
| SIMPUS MINI                              Pengguna | Logout   |
+----------------------+---------------------------------------+
| MENU                 | DASHBOARD                             |
|                      |                                       |
| Beranda              | Selamat Datang                        |
| Data Buku            |                                       |
| Data Anggota         | Ringkasan informasi aplikasi          |
| Peminjaman           |                                       |
|                      | [ Informasi / Statistik ]             |
|                      |                                       |
+----------------------+---------------------------------------+
```

### 3. Halaman Form Data

```text
+--------------------------------------------------+
|              TAMBAH / UBAH DATA                  |
+--------------------------------------------------+
|                                                  |
| Nama / Judul: [________________________]         |
|                                                  |
| Informasi:    [________________________]         |
|                                                  |
| Informasi:    [________________________]         |
|                                                  |
|                [      Simpan      ]              |
|                                                  |
|                [      Kembali     ]              |
+--------------------------------------------------+
```

### 4. Keterangan

* Halaman login digunakan untuk autentikasi pengguna.
* Dashboard menjadi halaman utama setelah pengguna berhasil login.
* Menu ditampilkan sesuai fitur dan hak akses pengguna.
* Form digunakan untuk menambah atau mengubah data.
* Validasi, CSRF token, dan pemeriksaan hak akses dilakukan ketika form diproses.

Wireframe ini merupakan rancangan struktur halaman, bukan gambaran visual final aplikasi.
