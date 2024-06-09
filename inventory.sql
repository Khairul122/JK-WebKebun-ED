-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2024 pada 13.59
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `contents` text NOT NULL,
  `admin` varchar(20) NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'aktif'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `notes`
--

INSERT INTO `notes` (`id`, `contents`, `admin`, `status`) VALUES
(21, 'Disini bisa tulis notes', 'Stock', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sbrg_keluar`
--

CREATE TABLE `sbrg_keluar` (
  `id` int(11) NOT NULL,
  `idx` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `penerima` varchar(35) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sbrg_keluar`
--

INSERT INTO `sbrg_keluar` (`id`, `idx`, `tgl`, `jumlah`, `penerima`, `keterangan`) VALUES
(16, 245, '2024-05-17', 1, 'BUDI', 'HAI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sbrg_masuk`
--

CREATE TABLE `sbrg_masuk` (
  `id` int(11) NOT NULL,
  `idx` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sbrg_masuk`
--

INSERT INTO `sbrg_masuk` (`id`, `idx`, `tgl`, `jumlah`, `keterangan`) VALUES
(13, 245, '2024-05-17', 1, 'DIPINJAM');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slogin`
--

CREATE TABLE `slogin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `slogin`
--

INSERT INTO `slogin` (`id`, `username`, `password`, `nickname`, `role`) VALUES
(7, 'guest', '084e0343a0486ff05530df6c705c8bb4', 'Stock', 'stock');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sstock_brg`
--

CREATE TABLE `sstock_brg` (
  `idx` int(11) NOT NULL,
  `nama` varchar(55) NOT NULL,
  `jenis` varchar(30) NOT NULL,
  `merk` varchar(40) NOT NULL,
  `stock` int(12) NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `lokasi` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `sstock_brg`
--

INSERT INTO `sstock_brg` (`idx`, `nama`, `jenis`, `merk`, `stock`, `satuan`, `lokasi`) VALUES
(245, 'PENA', 'ATK', 'JOYKO', 11, 'Unit', 'RAK'),
(256, 'Stiker pengiriman', 'Perlengkapan', '-', 10, 'Buah', 'Gudang'),
(255, 'Printer label', 'Perlengkapan', '-', 5, 'Buah', 'Gudang'),
(254, 'Bubble Warp', 'Perlengkapan', '-', 10, 'Unit', 'Gudang'),
(253, 'Kotak Karton', 'Perlengkapan', '-', 10, 'Buah', 'Gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kebun`
--

CREATE TABLE `tbl_kebun` (
  `id` int(11) NOT NULL,
  `kode_kebun` varchar(50) NOT NULL,
  `nama_kebun` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kebun`
--

INSERT INTO `tbl_kebun` (`id`, `kode_kebun`, `nama_kebun`) VALUES
(1, 'ABC1', 'ABC1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_nettosawit`
--

CREATE TABLE `tbl_nettosawit` (
  `id` int(11) NOT NULL,
  `tgl_terima` date NOT NULL,
  `tgl_dikirim` date NOT NULL,
  `no_spb` varchar(50) NOT NULL,
  `netto_kebun` int(11) NOT NULL,
  `alb` int(11) NOT NULL,
  `kadar_air` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_nettosawit`
--

INSERT INTO `tbl_nettosawit` (`id`, `tgl_terima`, `tgl_dikirim`, `no_spb`, `netto_kebun`, `alb`, `kadar_air`) VALUES
(2, '2024-06-09', '2024-06-09', '1', 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_timbang`
--

CREATE TABLE `tbl_timbang` (
  `id` int(11) NOT NULL,
  `penyusutan` int(10) NOT NULL,
  `netto_kebun` int(10) NOT NULL,
  `netto_ppl` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_timbang`
--

INSERT INTO `tbl_timbang` (`id`, `penyusutan`, `netto_kebun`, `netto_ppl`) VALUES
(2, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `slogin`
--
ALTER TABLE `slogin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sstock_brg`
--
ALTER TABLE `sstock_brg`
  ADD PRIMARY KEY (`idx`);

--
-- Indeks untuk tabel `tbl_kebun`
--
ALTER TABLE `tbl_kebun`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_nettosawit`
--
ALTER TABLE `tbl_nettosawit`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_timbang`
--
ALTER TABLE `tbl_timbang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `sbrg_keluar`
--
ALTER TABLE `sbrg_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `sbrg_masuk`
--
ALTER TABLE `sbrg_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `slogin`
--
ALTER TABLE `slogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `sstock_brg`
--
ALTER TABLE `sstock_brg`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT untuk tabel `tbl_kebun`
--
ALTER TABLE `tbl_kebun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_nettosawit`
--
ALTER TABLE `tbl_nettosawit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_timbang`
--
ALTER TABLE `tbl_timbang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
