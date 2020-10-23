-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 17, 2019 at 04:42 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_baju`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` char(1) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `nama_kategori`) VALUES
('1', 'Pakaian Pria'),
('2', 'Pakaian Wanita'),
('3', 'Pakaian Anak');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `username`, `nama_lengkap`, `email`, `password`, `level`) VALUES
(1, 'admin', 'Hanif Ramadhan', 'hanif@gmail.com', 'admin123', 1),
(5, 'manager', 'Nama Manager 3', 'manager@gmail.com', 'manager123', 2);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` char(6) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `deskripsi` varchar(500) NOT NULL,
  `idkategori` char(1) NOT NULL,
  `idsub_kategori` char(3) NOT NULL,
  `file_gambar` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  `idpegawai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `nama`, `deskripsi`, `idkategori`, `idsub_kategori`, `file_gambar`, `harga`, `jumlah`, `last_update`, `idpegawai`) VALUES
('101001', 'Kemeja 1', 'Kemeja berbahan dasar jeans', '1', '101', 'kemeja1.jpg', 50000, 33, '0000-00-00 00:00:00', 1),
('102001', 'Celana Panjang 1', 'Celana ini berbahan dasar jeans', '1', '102', 'celanapanjang1.jpg', 100000, 30, '0000-00-00 00:00:00', 1),
('103001', 'Celana Pendek 1', 'Celana ini berbahan dasar jeans', '1', '103', 'celanapendek1.jpg', 90000, 100, '0000-00-00 00:00:00', 1),
('103002', 'Celana pendek 2', 'Celana ini jenis celana army', '1', '103', 'celanapendek2.jpg', 80000, 60, '0000-00-00 00:00:00', 1),
('201001', 'Atasan Wanita 1', 'Atasan wanita blouse bahan cotton', '2', '201', 'atasanwanita1.jpg', 88000, 68, '0000-00-00 00:00:00', 1),
('301001', 'Setelan Anak 1', 'Setelan anak perempuan umur 3-4 tahun', '3', '301', 'setelananak1.jpg', 90000, 49, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sub_kategori`
--

CREATE TABLE `sub_kategori` (
  `idsub_kategori` char(3) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `idkategori` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_kategori`
--

INSERT INTO `sub_kategori` (`idsub_kategori`, `nama`, `idkategori`) VALUES
('101', 'Kemeja', '1'),
('102', 'Celana Panjang', '1'),
('103', 'Celana Pendek', '1'),
('201', 'Atasan', '2'),
('202', 'Rok', '2'),
('301', 'Setelan Anak', '3'),
('302', 'Celana kotak', '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `produk_ibfk_1` (`idkategori`),
  ADD KEY `produk_ibfk_2` (`idsub_kategori`),
  ADD KEY `produk_ibfk_3` (`idpegawai`);

--
-- Indexes for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD PRIMARY KEY (`idsub_kategori`),
  ADD KEY `sub_kategori_ibfk_1` (`idkategori`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_2` FOREIGN KEY (`idsub_kategori`) REFERENCES `sub_kategori` (`idsub_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produk_ibfk_3` FOREIGN KEY (`idpegawai`) REFERENCES `pegawai` (`idpegawai`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_kategori`
--
ALTER TABLE `sub_kategori`
  ADD CONSTRAINT `sub_kategori_ibfk_1` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
