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
