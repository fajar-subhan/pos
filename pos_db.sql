-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 07, 2021 at 11:12 AM
-- Server version: 10.2.39-MariaDB-log-cll-lve
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fajarsub_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE `beli` (
  `id_beli` int(10) NOT NULL,
  `no_trans` varchar(20) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `harga_beli` varchar(30) NOT NULL,
  `harga_jual` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `uploader` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beli`
--

INSERT INTO `beli` (`id_beli`, `no_trans`, `supplier`, `kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `qty`, `total_harga`, `tanggal`, `uploader`) VALUES
(1, 'B-210719-0001', 'PT Dinar Computer', 'HDD80', 'Hardisk 80', '500.000', '600.000', 5, '2500000', '2021-07-19', 'Admin');

--
-- Triggers `beli`
--
DELIMITER $$
CREATE TRIGGER `beli_barang` AFTER INSERT ON `beli` FOR EACH ROW BEGIN
INSERT INTO stok SET
kd_barang = new.kd_barang,qty = new.qty
ON DUPLICATE KEY UPDATE qty = qty + new.qty;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `id_jual` int(10) NOT NULL,
  `no_trans` varchar(20) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `harga_jual` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`id_jual`, `no_trans`, `nama_pembeli`, `nama_barang`, `kd_barang`, `harga_jual`, `qty`, `total_harga`, `uploader`, `tanggal`) VALUES
(1, 'J-210719-0001', 'Fajar Subhan', 'Hardisk 80', 'HDD80', '600.000', 2, '600000', 'Admin', '2021-07-19');

--
-- Triggers `jual`
--
DELIMITER $$
CREATE TRIGGER `total_harga` AFTER INSERT ON `jual` FOR EACH ROW BEGIN
UPDATE stok SET qty = qty - new.qty
WHERE kd_barang = new.kd_barang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id_jual` int(11) NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat_perusahaan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_jual`, `nama_perusahaan`, `alamat_perusahaan`) VALUES
(1, 'PT FAJAR SUBHAN', 'JL.Agung Raya,G.Pandawa III,Lenteng Agung');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE `stok` (
  `kd_barang` varchar(20) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`kd_barang`, `qty`) VALUES
('HDD80', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(40) NOT NULL,
  `jabatan_user` varchar(25) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe_user` int(2) NOT NULL COMMENT '1=admin,2=user',
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `jabatan_user`, `username`, `password`, `tipe_user`, `tanggal`) VALUES
(1, 'Admin', 'fajar@fajarsubhan.my.id', 'Staff', 'Admin', '$2y$10$zbtk4Qfr8B0ANAttWKBYmehLOxrJ59yYaBMO/in9yD7SmVgen0tgC', 1, '2021-02-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `beli`
--
ALTER TABLE `beli`
  ADD PRIMARY KEY (`id_beli`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`id_jual`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id_jual`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `beli`
--
ALTER TABLE `beli`
  MODIFY `id_beli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `id_jual` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
