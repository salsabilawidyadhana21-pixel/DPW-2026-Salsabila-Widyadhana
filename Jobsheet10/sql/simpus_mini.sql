CREATE DATABASE simpus_mini;

CREATE TABLE buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(150) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    tahun INTEGER NOT NULL,
    isbn VARCHAR(30),
    stok INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(30)
);

CREATE TABLE anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    no_anggota VARCHAR(30) NOT NULL UNIQUE,
    alamat TEXT,
    no_hp VARCHAR(20)
);

-- =====================================================
-- TAMBAHAN JOBSHEET 9
-- DATA CONTOH UNTUK TEST CRUD DAN PAGINATION
-- =====================================================


-- =====================================================
-- TAMBAHAN DATA BUKU
-- =====================================================

DELETE FROM buku;

INSERT INTO buku
    (judul, pengarang, tahun, isbn, stok, kategori)
VALUES
    ('Laskar Pelangi', 'Andrea Hirata', 2005, '9789793062792', 10, 'Novel'),
    ('Sang Pemimpi', 'Andrea Hirata', 2006, '9789793062791', 8, 'Novel'),
    ('Negeri 5 Menara', 'Ahmad Fuadi', 2009, '9789792254862', 7, 'Novel'),
    ('Bumi Manusia', 'Pramoedya Ananta Toer', 1980, '9789799731234', 6, 'Novel'),
    ('Perahu Kertas', 'Dee Lestari', 2009, '9789791227653', 5, 'Novel'),
    ('Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 2004, '9789793604109', 9, 'Novel'),
    ('Ronggeng Dukuh Paruk', 'Ahmad Tohari', 1982, '9789792200335', 4, 'Novel'),
    ('Dilan 1990', 'Pidi Baiq', 2014, '9786027870103', 8, 'Novel');

-- =====================================================
-- TAMBAHAN DATA ANGGOTA
-- =====================================================

INSERT INTO anggota
(nama, no_anggota, alamat, no_hp)
VALUES
('Ahmad Fauzi', 'AGT001', 'Malang', '081234567801'),
('Budi Santoso', 'AGT002', 'Malang', '081234567802'),
('Citra Dewi', 'AGT003', 'Kediri', '081234567803'),
('Deni Pratama', 'AGT004', 'Blitar', '081234567804'),
('Eka Putri', 'AGT005', 'Malang', '081234567805'),
('Fajar Nugroho', 'AGT006', 'Kediri', '081234567806'),
('Gilang Ramadhan', 'AGT007', 'Blitar', '081234567807'),
('Hendra Saputra', 'AGT008', 'Malang', '081234567808'),
('Indah Permata', 'AGT009', 'Kediri', '081234567809'),
('Joko Susanto', 'AGT010', 'Malang', '081234567810'),
('Kiki Amelia', 'AGT011', 'Blitar', '081234567811'),
('Lina Maharani', 'AGT012', 'Malang', '081234567812');


-- =====================================================
-- CEK DATA TAMBAHAN
-- =====================================================

SELECT * FROM buku
ORDER BY id DESC;

SELECT * FROM anggota
ORDER BY id DESC;

-- =====================================================
-- JOBSHEET 10
-- =====================================================

-- Tabel users digunakan untuk menyimpan
-- data pengguna yang dapat login ke sistem.

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);

-- Mengecek apakah tabel users sudah berhasil dibuat
SELECT * FROM users;

UPDATE users
SET role = 'admin'
WHERE username = 'salsa';

SELECT id, nama, username, role
FROM users
WHERE username = 'salsa';

UPDATE users
SET role = 'petugas'
WHERE username = 'salsa';

SELECT id, nama, username, role
FROM users
WHERE username = 'salsa';

SELECT id, nama, username, role, password
FROM users
WHERE username = 'salsa';
