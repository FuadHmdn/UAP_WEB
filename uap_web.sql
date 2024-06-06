-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2024 at 05:41 PM
-- Server version: 10.4.32-MariaDB-log
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uap_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `id_bus` int(11) NOT NULL,
  `nomor_polisi` varchar(20) NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `model` varchar(50) NOT NULL,
  `tahun_pembuatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`id_bus`, `nomor_polisi`, `kapasitas`, `model`, `tahun_pembuatan`) VALUES
(1, 'BE 4521 OL', 30, 'Volvo', '2016-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `penumpang`
--

CREATE TABLE `penumpang` (
  `id_penumpang` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` int(11) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `nomor_telepon` bigint(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penumpang`
--

INSERT INTO `penumpang` (`id_penumpang`, `nama`, `umur`, `alamat`, `nomor_telepon`, `email`) VALUES
(1, 'Dhimas Kurniawan', 20, 'Bandar Lampung', 89521245863, 'dhimaskur@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `perjalanan`
--

CREATE TABLE `perjalanan` (
  `id_perjalanan` int(11) NOT NULL,
  `id_bus` int(11) NOT NULL,
  `id_supir` int(11) NOT NULL,
  `tanggal_berangkat` datetime NOT NULL,
  `tanggal_tiba` datetime NOT NULL,
  `rute` varchar(255) NOT NULL,
  `harga_tiket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perjalanan`
--

INSERT INTO `perjalanan` (`id_perjalanan`, `id_bus`, `id_supir`, `tanggal_berangkat`, `tanggal_tiba`, `rute`, `harga_tiket`) VALUES
(2, 1, 1, '2024-05-29 22:30:08', '2024-05-31 22:30:08', 'Bandar Lampung - Jakarta', 300000);

-- --------------------------------------------------------

--
-- Table structure for table `supir`
--

CREATE TABLE `supir` (
  `id_supir` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` bigint(20) NOT NULL,
  `no_sim` bigint(20) NOT NULL,
  `umur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supir`
--

INSERT INTO `supir` (`id_supir`, `nama`, `alamat`, `no_telpon`, `no_sim`, `umur`) VALUES
(1, 'Rifqi Yanto', 'Jambi City', 81284739402, 23454323433, 21);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_perjalanan` int(11) NOT NULL,
  `id_penumpang` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `jumlah_tiket` int(11) NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_perjalanan`, `id_penumpang`, `tanggal_transaksi`, `jumlah_tiket`, `total_bayar`, `metode_pembayaran`) VALUES
(1, 2, 1, '2024-05-28 22:32:32', 1, 300000.00, 'Dana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`id_bus`);

--
-- Indexes for table `penumpang`
--
ALTER TABLE `penumpang`
  ADD PRIMARY KEY (`id_penumpang`);

--
-- Indexes for table `perjalanan`
--
ALTER TABLE `perjalanan`
  ADD PRIMARY KEY (`id_perjalanan`),
  ADD KEY `id_bus` (`id_bus`),
  ADD KEY `id_supir` (`id_supir`);

--
-- Indexes for table `supir`
--
ALTER TABLE `supir`
  ADD PRIMARY KEY (`id_supir`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_perjalanan` (`id_perjalanan`),
  ADD KEY `id_penumpang` (`id_penumpang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bus`
--
ALTER TABLE `bus`
  MODIFY `id_bus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `penumpang`
--
ALTER TABLE `penumpang`
  MODIFY `id_penumpang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `perjalanan`
--
ALTER TABLE `perjalanan`
  MODIFY `id_perjalanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supir`
--
ALTER TABLE `supir`
  MODIFY `id_supir` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perjalanan`
--
ALTER TABLE `perjalanan`
  ADD CONSTRAINT `perjalanan_ibfk_1` FOREIGN KEY (`id_bus`) REFERENCES `bus` (`id_bus`),
  ADD CONSTRAINT `perjalanan_ibfk_2` FOREIGN KEY (`id_supir`) REFERENCES `supir` (`id_supir`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_perjalanan`) REFERENCES `perjalanan` (`id_perjalanan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_penumpang`) REFERENCES `penumpang` (`id_penumpang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
