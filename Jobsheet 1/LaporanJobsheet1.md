# LAPORAN PRAKTIKUM
# JOBSHEET 1 – MINGGU 2
# MENYUSUN STRUKTUR HALAMAN WEB DENGAN HTML5 SEMANTIC

Nama   : Salsabila Widyadhana

NIM    : 254107020200

Kelas  : TI-2F

Matkul : Desain Pemrograman Web 

# A. TUJUAN PRAKTIKUM

Tujuan dari praktikum ini adalah:

1. Mahasiswa mampu memahami struktur dasar dokumen HTML5.
2. Mahasiswa mampu menggunakan tag HTML5 semantic dalam pembuatan halaman web.
3. Mahasiswa mampu membuat struktur navigasi antarhalaman.
4. Mahasiswa mampu membuat tabel untuk menampilkan data.
5. Mahasiswa mampu membuat form input menggunakan HTML.
6. Mahasiswa mampu membuat beberapa halaman web yang saling terhubung.

# B. BEBERAPA TAG YANG DIGUNAKAN DI PRAKTIKUM INI:
1. header

Tag header digunakan untuk bagian kepala halaman. Biasanya berisi judul website, logo, atau informasi utama.

2. nav

Tag nav digunakan untuk membuat bagian navigasi yang berisi link menuju halaman lain.

3. main

Tag main digunakan untuk menampilkan isi utama dari sebuah halaman web.

4. section

Tag section digunakan untuk mengelompokkan konten berdasarkan bagian atau topik tertentu.

5. article

Tag article digunakan untuk menampilkan konten yang berdiri sendiri, seperti artikel atau informasi tertentu.

6. footer

Tag footer digunakan untuk bagian bawah halaman. Biasanya berisi informasi hak cipta atau informasi tambahan.

Selain tag semantic, praktikum ini juga menggunakan tabel dengan tag table, thead, dan tbody. Untuk membuat form digunakan tag form, label, input, select, textarea, dan button.

# C. LANGKAH PENGERJAAN 

### 1. Membuat Folder Project

Langkah pertama adalah membuat folder project dengan nama:

simus-mini

Kemudian dibuat struktur folder sebagai berikut:

<img width="84" height="103" alt="image" src="https://github.com/user-attachments/assets/3cc869ce-b5ae-49c6-b02f-65c46d883ca7" />

### 2. Membuat Halaman Beranda

File index.html digunakan sebagai halaman utama aplikasi SIMUS Mini. Halaman ini menggunakan struktur HTML5 semantic seperti header, nav, main, section, article, dan footer.

Pada bagian navigasi terdapat link menuju halaman:

Beranda
Daftar Buku
Tambah Buku
Daftar Anggota
Tambah Anggota

Halaman beranda berfungsi sebagai halaman utama yang memberikan informasi mengenai aplikasi SIMUS Mini.

### 3. Membuat Halaman Daftar Buku

- Halaman Daftar Buku dibuat pada file:

buku/list.html

- Halaman ini digunakan untuk menampilkan data buku dalam bentuk tabel.

- Tabel terdiri dari beberapa kolom, yaitu:

No
Judul
Pengarang
Tahun
Stok
Aksi

- Data buku yang ditampilkan masih berupa data dummy sebanyak lima baris.

- Pada kolom aksi terdapat tombol:

Edit
Hapus

- Tombol tersebut masih belum memiliki fungsi karena di praktikum ini hanya berfokus pada pembuatan struktur halaman HTML.

### 4. Membuat Form Tambah Buku

- Halaman Form Tambah Buku dibuat pada file:

buku/tambah.html

- Form yang dibuat memiliki beberapa field, yaitu:

Judul
Pengarang
Tahun
ISBN
Stok
Kategori

- Untuk kategori digunakan elemen <select> agar pengguna dapat memilih kategori buku.

- Setiap input menggunakan atribut id dan name yang konsisten. Contohnya:

<input type="text" id="judul" name="judul">

- Hal tersebut dilakukan agar struktur form lebih rapi dan sesuai dengan standar penamaan yang digunakan.

### 5. Membuat Halaman Daftar Anggota

- Halaman Daftar Anggota dibuat pada file:

anggota/list.html

- Halaman ini merupakan tugas mandiri yang dibuat menggunakan struktur semantic HTML yang sama.

- Data anggota ditampilkan dalam bentuk tabel dengan kolom:

No
Nama
Nomor Anggota
Alamat
Nomor HP
Aksi

- Pada bagian aksi terdapat tombol Edit dan Hapus.

### 6. Membuat Form Tambah Anggota

- Halaman Form Tambah Anggota dibuat pada file:

anggota/tambah.html

- Field yang terdapat dalam form adalah:

Nama
Nomor Anggota
Alamat
Nomor HP

- Elemen <textarea> digunakan pada bagian alamat karena alamat dapat terdiri dari lebih dari satu baris.

### 7. Menjalankan Program

- Setelah seluruh file selesai dibuat, halaman web dijalankan menggunakan extension Live Server pada Visual Studio Code.

- Langkah menjalankan program adalah:

Membuka file index.html.
Memastikan semua file sudah disimpan.
Menjalankan Live Server.
Membuka halaman web melalui browser.
Menguji setiap link pada menu navigasi.

- Halaman dapat diakses melalui alamat localhost yang dibuat oleh Live Server.

# D. HASIL PRAKTIKUM 
### 1. Halaman Beranda

Halaman ini menampilkan judul aplikasi, navigasi, informasi singkat mengenai SIMUS Mini, serta menu menuju halaman data buku dan data anggota.

#### Dokumentasi hasil:
<img width="441" height="292" alt="image" src="https://github.com/user-attachments/assets/3bcbec0f-cd56-4e57-bd2e-381e8def7f41" />

### 2. Halaman Daftar Buku

Halaman ini menampilkan lima data buku dalam bentuk tabel.

#### Dokumentasi hasil:
<img width="333" height="202" alt="image" src="https://github.com/user-attachments/assets/dee67a56-befd-499e-917a-9e781c08d5d6" />

### 3. Halaman Tambah Buku

Halaman ini menampilkan form yang dapat digunakan untuk memasukkan data buku.

Field yang tersedia terdiri dari judul, pengarang, tahun, ISBN, stok, dan kategori.

#### Dokumentasi hasil:
<img width="286" height="286" alt="image" src="https://github.com/user-attachments/assets/369fa503-f17e-4c71-8131-774078e0f527" />

### 4. Halaman Daftar Anggota

Halaman ini menampilkan data anggota dalam bentuk tabel.

#### Dokumentasi hasil:
<img width="269" height="196" alt="image" src="https://github.com/user-attachments/assets/a9d48a2c-0a63-4df0-a779-6349931140a1" />

### 5. Halaman Tambah Anggota

Halaman ini menampilkan form untuk memasukkan data anggota.

#### Dokumentasi hasil:
<img width="308" height="263" alt="image" src="https://github.com/user-attachments/assets/d40658b9-5912-405a-bf97-72346f6f5097" />




