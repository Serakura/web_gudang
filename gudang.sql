-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2022 pada 12.59
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` varchar(11) NOT NULL,
  `idbarang` varchar(11) NOT NULL,
  `idpermintaanbarang` varchar(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `pelaksanalapangan` varchar(50) NOT NULL,
  `jumlahbarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `idpermintaanbarang`, `tanggal`, `pelaksanalapangan`, `jumlahbarang`) VALUES
('k1', 'b2', 'p1', '2022-12-10 03:40:20', 'Supri', 20),
('k2', 'b4', 'p2', '2022-12-10 03:42:09', 'Yanto', 100),
('k3', 'b5', 'p3', '2022-12-10 03:42:39', 'Dimas', 10),
('k4', 'b1', 'p4', '2022-12-10 03:43:38', 'Supri', 20);

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` varchar(11) NOT NULL,
  `idbarang` varchar(11) NOT NULL,
  `idsupplier` varchar(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `supplier` varchar(25) NOT NULL,
  `jumlahbarang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `idsupplier`, `tanggal`, `supplier`, `jumlahbarang`) VALUES
('m1', 'b1', 's1', '2022-12-10 03:35:37', 'Depot Restu Ibu', 10),
('m2', 'b3', 's2', '2022-12-10 03:37:07', 'Depot Karunia Jaya', 1),
('m3', 'b4', 's3', '2022-12-10 03:38:14', 'Depot Maju Jaya', 1000),
('m4', 'b5', 's4', '2022-12-10 03:39:17', 'Depot Restu Ibu', 19);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permintaanbarang`
--

CREATE TABLE `permintaanbarang` (
  `idpermintaanbarang` varchar(11) NOT NULL,
  `idbarang` varchar(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `jumlahbarang` int(11) NOT NULL,
  `pelaksanalapangan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `permintaanbarang`
--

INSERT INTO `permintaanbarang` (`idpermintaanbarang`, `idbarang`, `tanggal`, `jumlahbarang`, `pelaksanalapangan`) VALUES
('p1', 'b2', '2022-12-10 03:40:05', 20, 'Supri'),
('p2', 'b4', '2022-12-10 03:40:45', 100, 'Yanto'),
('p3', 'b5', '2022-12-10 03:42:27', 10, 'Dimas'),
('p4', 'b1', '2022-12-10 03:42:55', 20, 'Supri');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rab`
--

CREATE TABLE `rab` (
  `idrab` int(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `satuan` varchar(11) NOT NULL,
  `jumlahbarang` int(11) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rab`
--

INSERT INTO `rab` (`idrab`, `namabarang`, `satuan`, `jumlahbarang`, `hargasatuan`, `totalharga`) VALUES
(1, 'Keramik', 'Dus', 50, 45000, 2250000),
(2, 'Pintu Panel', 'Dus', 50, 45000, 2250000),
(3, 'Pasir', 'Dus', 20, 100000, 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idbarang` varchar(11) NOT NULL,
  `idrab` varchar(11) NOT NULL,
  `namabarang` varchar(25) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL,
  `hargasatuan` int(11) NOT NULL,
  `totalharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`idbarang`, `idrab`, `namabarang`, `satuan`, `stock`, `hargasatuan`, `totalharga`) VALUES
('b1', '', 'Pasir', 'M3', 10, 100000, 1000000),
('b2', '', 'Semen ', 'ZAK', 50, 54000, 2700000),
('b3', '', 'Koral', 'M3', 3, 400000, 1200000),
('b4', '', 'Batako', 'BH', 3900, 2000, 7800000),
('b5', '', 'Genteng', 'KPG', 100, 25000, 2500000),
('b6', '2', 'Pintu Panel', 'Dus', 150, 120000, 18000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `idsupplier` varchar(11) NOT NULL,
  `idbarang` varchar(11) NOT NULL,
  `namasupplier` varchar(25) NOT NULL,
  `jumlahbarang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `alamat` varchar(50) NOT NULL,
  `kontak` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`idsupplier`, `idbarang`, `namasupplier`, `jumlahbarang`, `harga`, `tanggal`, `alamat`, `kontak`) VALUES
('s1', 'b1', 'Depot Restu Ibu', 10, 1000000, '2022-12-10 03:35:00', 'Jln. Prajurit No.34 RT. 32 RW.09 Kalidoni', '081368296576'),
('s2', 'b3', 'Depot Karunia Jaya', 1, 400000, '2022-12-10 03:36:50', 'Jln. Mayor Zen Pusri No.12', '082267789812'),
('s3', 'b4', 'Depot Maju Jaya', 1000, 2000000, '2022-12-10 03:37:51', 'Jln. Pandawa No.39 Plaju', '083865671312'),
('s4', 'b5', 'Depot Restu Ibu', 19, 475000, '2022-12-10 03:39:02', 'Jln. Prajurit No.34 RT. 32 RW.09 Kalidoni', '081368296576');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indeks untuk tabel `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indeks untuk tabel `permintaanbarang`
--
ALTER TABLE `permintaanbarang`
  ADD PRIMARY KEY (`idpermintaanbarang`);

--
-- Indeks untuk tabel `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`idrab`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`idsupplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `rab`
--
ALTER TABLE `rab`
  MODIFY `idrab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
