-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Nov 2026 pada 14.26
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rk_bibit_id`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password_hash`) VALUES
(1, 'admin', '$2y$10$7KaWrdhaCYUJZ2zVJq3PhOz3jiIKVijkKk/XkI4KQAhkuycTSAKHG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bibit`
--

CREATE TABLE `bibit` (
  `id_bibit` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `nama` varchar(80) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `ringkas` varchar(120) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `cahaya` varchar(100) DEFAULT NULL,
  `air` varchar(100) DEFAULT NULL,
  `media` varchar(100) DEFAULT NULL,
  `tinggi` varchar(30) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bibit`
--

INSERT INTO `bibit` (`id_bibit`, `id_kategori`, `nama`, `harga`, `stok`, `ringkas`, `deskripsi`, `cahaya`, `air`, `media`, `tinggi`, `gambar`) VALUES
(1, 1, 'Bibit Kelengkeng Matalada', 50000, 18, 'Kelengkeng berbiji kecil & cepat berbuah', 'Varietas kelengkeng berbiji lada, kulit putih bening, manis dan aroma harum.', 'Matahari penuh 6-8 jam', '1 kali sehari', 'Tanah gembur + sekam', '40-50 cm', 'kelengkeng_matalada.jpg'),
(2, 1, 'Bibit Mangga Kiojay', 55000, 20, 'Mangga jumbo manis dan renyah', 'Varietas mangga ukuran jumbo, daging tebal dan cocok untuk tabulampot.', 'Matahari penuh 6-8 jam', '1-2 kali sehari', 'Tanah gembur + kompos', '60-70 cm', 'mangga_kiojay.jpg'),
(3, 1, 'Bibit Nangka Madu', 40000, 12, 'Nangka daging tebal manis legit', 'Bibit nangka madu genjah unggul dengan aroma khas madu.', 'Matahari penuh 6-8 jam', '1 kali sehari', 'Tanah gembur', '50-60 cm', 'nangka_madu.jpg'),
(4, 1, 'Bibit Sawo Jumbo Vietnam', 45000, 15, 'Sawo ukuran besar & cepat berbuah', 'Varietas sawo asal Vietnam dengan ukuran buah besar dan rasa sangat manis.', 'Matahari penuh 6-8 jam', '1 kali sehari', 'Tanah gembur', '45-55 cm', 'sawo_vietnam.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Buah'),
(5, 'Hias'),
(6, 'Bunga'),
(7, 'Sayur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(80) NOT NULL,
  `deskripsi_toko` text DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `jam` varchar(80) DEFAULT NULL,
  `wa` varchar(20) DEFAULT NULL,
  `shopee` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `deskripsi_toko`, `alamat`, `jam`, `wa`, `shopee`, `tiktok`) VALUES
(1, 'RK BIBIT ID', 'Toko bibit tanaman buah, Menyediakan berbagai macam bibit tanaman buah unggul dan berkualitas, seperti kelengkeng matalada, mangga kiojay, nangka madu, dan sawo jumbo vietnam.', 'Nganjuk, Jawa Timur', 'Setiap hari, 08.00-16.00', '083103240301', 'https://s.shopee.co.id/60T3J16slD?share_channel_code=1', 'https://vt.tiktok.com/ZS9fAWRqpgWCw-V3yxd/');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `bibit`
--
ALTER TABLE `bibit`
  ADD PRIMARY KEY (`id_bibit`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bibit`
--
ALTER TABLE `bibit`
  MODIFY `id_bibit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bibit`
--
ALTER TABLE `bibit`
  ADD CONSTRAINT `bibit_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
