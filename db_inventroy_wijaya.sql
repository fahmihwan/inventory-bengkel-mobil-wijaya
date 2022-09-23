-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Sep 23, 2022 at 11:46 AM
-- Server version: 5.7.34
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_inventroy_wijaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `merek_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `rak_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `merek_id`, `kategori_id`, `rak_id`, `qty`) VALUES
(4, 'OLI-enduro', 2, 23, 5, 35),
(5, 'Aki Mobil GS Astra', 8, 24, 5, 44),
(6, 'Aki Mobil Bosch', 4, 24, 7, 23),
(7, 'Aki Mobil Incoe', 6, 24, 6, 4),
(8, 'NHK Racing ', 6, 20, 9, 23),
(9, 'spion EMGI', 2, 25, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `kode_referensi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `montir_id` int(11) NOT NULL,
  `catatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `kode_referensi`, `tanggal`, `montir_id`, `catatan`) VALUES
(14, 'OUT20220918002', '2022-09-19', 1, 'dasdsads'),
(15, 'OUT20220918003', '2022-09-19', 1, 'sdasdsad'),
(38, 'OUT20220921001', '2022-09-24', 1, 'sasdasdad'),
(39, 'OUT20220921002', '2022-09-22', 4, 'asddsad'),
(40, 'OUT20220921003', '2022-09-22', 1, 'asdasda'),
(41, 'OUT20220922001', '2022-08-09', 1, 'asdasdasd'),
(42, 'OUT20220923001', '2022-09-23', 1, 'SADASDASDA');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` int(11) NOT NULL,
  `no_referensi` varchar(100) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `catatan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id`, `no_referensi`, `supplier_id`, `tanggal`, `catatan`) VALUES
(27, 'IN20220918001', 4, '2022-09-18', 'opiopietopreitpoiertpierptiert'),
(29, 'IN20220918003', 4, '2022-09-19', 'dasdadasd'),
(39, 'IN20220921001', 2, '2022-09-22', 'ccxzcxzcxzc'),
(40, 'IN20220921002', 5, '2022-10-05', 'sdasdsad'),
(41, 'IN20220923001', 4, '2022-09-22', 'SADADASD');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(20, 'knalpot'),
(22, 'velg'),
(23, 'oli'),
(24, 'Aki'),
(25, 'spion');

-- --------------------------------------------------------

--
-- Table structure for table `merek`
--

CREATE TABLE `merek` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `merek`
--

INSERT INTO `merek` (`id`, `nama`) VALUES
(2, 'kawahara'),
(4, 'SBS'),
(6, 'lexus'),
(7, 'mazzoa'),
(8, 'nissan'),
(9, 'enduro');

-- --------------------------------------------------------

--
-- Table structure for table `montir`
--

CREATE TABLE `montir` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `telp` char(20) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` enum('aktif','non-aktif') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `montir`
--

INSERT INTO `montir` (`id`, `nama`, `telp`, `alamat`, `status`) VALUES
(1, 'angga', '123123', 'godean', 'aktif'),
(4, 'daffa', '08233213123', 'yogyakarta', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `nama`) VALUES
(5, 'A-001'),
(6, 'A-002'),
(7, 'A-003'),
(8, 'B-001'),
(9, 'B-002'),
(10, 'B-003');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telp` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `telp`) VALUES
(2, 'wijaya', 'qwdkjqdk', '123123'),
(4, 'anas', 'qweqwe', '123132'),
(5, 'ridwan', 'godean', '0823232323');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang_keluar`
--

CREATE TABLE `transaksi_barang_keluar` (
  `id` int(11) NOT NULL,
  `barang_keluar_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_barang_keluar`
--

INSERT INTO `transaksi_barang_keluar` (`id`, `barang_keluar_id`, `barang_id`, `qty`) VALUES
(14, 14, 4, 9),
(15, 15, 4, 8),
(41, 15, 4, 2),
(42, 15, 6, 2),
(47, 38, 5, 2),
(48, 39, 7, 2),
(49, 39, 7, 2),
(50, 40, 4, 2),
(51, 41, 4, 3),
(52, 41, 7, 3),
(53, 42, 9, 16);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_barang_masuk`
--

CREATE TABLE `transaksi_barang_masuk` (
  `id` int(11) NOT NULL,
  `barang_masuk_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi_barang_masuk`
--

INSERT INTO `transaksi_barang_masuk` (`id`, `barang_masuk_id`, `barang_id`, `qty`) VALUES
(33, 27, 4, 10),
(35, 29, 7, 11),
(36, 29, 5, 3),
(37, 29, 4, 5),
(50, 29, 4, 1),
(55, 27, 7, 2),
(68, 39, 5, 2),
(69, 40, 5, 1),
(70, 40, 7, 1),
(71, 41, 9, 18);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` enum('admin','operator','super admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `hak_akses`) VALUES
(5, 'admin jaya', 'admin', '$2y$10$6AvPabKzN0OCS4WM43rEbeD1BdOdyjVPChFAcPiNIqRR.v.6sm5C2', 'admin'),
(6, 'operator', 'operator', '$2y$10$.2eg.2qIMAmpudLI1h2aZuDqMjR8ZxwUMne0EDuLwiyqOYHGgttN6', 'operator'),
(7, 'super admin', 'super admin', '$2y$10$cUDjopKFmkTW2GfwUpSpq.j9Lu0tSXNQLcOaW3xosvXlKRz87Rfw2', 'super admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merek_id` (`merek_id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `rak_id` (`rak_id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `montir_id` (`montir_id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `merek`
--
ALTER TABLE `merek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `montir`
--
ALTER TABLE `montir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_keluar_id` (`barang_keluar_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_masuk_id` (`barang_masuk_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `merek`
--
ALTER TABLE `merek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `montir`
--
ALTER TABLE `montir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`merek_id`) REFERENCES `merek` (`id`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`rak_id`) REFERENCES `rak` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD CONSTRAINT `barang_keluar_ibfk_2` FOREIGN KEY (`montir_id`) REFERENCES `montir` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD CONSTRAINT `barang_masuk_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_barang_keluar`
--
ALTER TABLE `transaksi_barang_keluar`
  ADD CONSTRAINT `transaksi_barang_keluar_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_barang_keluar_ibfk_2` FOREIGN KEY (`barang_keluar_id`) REFERENCES `barang_keluar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_barang_masuk`
--
ALTER TABLE `transaksi_barang_masuk`
  ADD CONSTRAINT `transaksi_barang_masuk_ibfk_1` FOREIGN KEY (`barang_masuk_id`) REFERENCES `barang_masuk` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_barang_masuk_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
