## Wireframe

Wireframe Jobsheet 10 merupakan pengembangan dari Jobsheet 9 dengan penambahan halaman **Register, Login, dan Dashboard** untuk mendukung autentikasi dan manajemen session.

### Halaman Register

```text
┌───────────────────────────────────────┐
│             SIMPUS-Mini               │
├───────────────────────────────────────┤
│                                       │
│          REGISTRASI PENGGUNA          │
│                                       │
│  Nama                                  │
│  [____________________________]       │
│                                       │
│  Username                              │
│  [____________________________]       │
│                                       │
│  Password                              │
│  [____________________________]       │
│                                       │
│  Role                                  │
│  [ Admin / Petugas          ▼ ]       │
│                                       │
│          [ Daftar ]                   │
│                                       │
│  Sudah punya akun? Login              │
│                                       │
└───────────────────────────────────────┘
```

## Halaman Login
```
┌───────────────────────────────────────┐
│             SIMPUS-Mini               │
├───────────────────────────────────────┤
│                                       │
│              LOGIN                    │
│                                       │
│  Username                              │
│  [____________________________]       │
│                                       │
│  Password                              │
│  [____________________________]       │
│                                       │
│          [ Login ]                    │
│                                       │
│  Belum punya akun? Register           │
│                                       │
└───────────────────────────────────────┘
```

## Halaman Dashboard
```
┌─────────────────────────────────────────────────────┐
│ SIMPUS-Mini                         Logout           │
├─────────────────────────────────────────────────────┤
│ Beranda │ Daftar Buku │ Tambah Buku │ Daftar Anggota│
├─────────────────────────────────────────────────────┤
│                                                     │
│              Selamat Datang, [Nama]                 │
│                                                     │
│              Role: [Admin/Petugas]                  │
│                                                     │
│  ┌───────────┐  ┌───────────┐  ┌───────────┐       │
│  │ Total     │  │ Total     │  │ Sedang    │       │
│  │ Buku      │  │ Anggota   │  │ Dipinjam  │       │
│  └───────────┘  └───────────┘  └───────────┘       │
│                                                     │
└─────────────────────────────────────────────────────┘
```

## Alur Autentikasi
```
              ┌──────────────┐
              │   Register   │
              └──────┬───────┘
                     ↓
              ┌──────────────┐
              │    Login     │
              └──────┬───────┘
                     ↓
              ┌──────────────┐
              │   Session    │
              │   dibuat     │
              └──────┬───────┘
                     ↓
              ┌──────────────┐
              │  Dashboard   │
              └──────┬───────┘
                     ↓
              ┌──────────────┐
              │ Akses sesuai │
              │     role     │
              └──────┬───────┘
                     ↓
              ┌──────────────┐
              │    Logout    │
              └──────────────┘
```
