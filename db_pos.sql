-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2019 at 09:45 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `beli`
--

CREATE TABLE IF NOT EXISTS `beli` (
  `id_beli` int(10) NOT NULL AUTO_INCREMENT,
  `no_trans` varchar(20) NOT NULL,
  `supplier` varchar(50) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `nama_barang` varchar(20) NOT NULL,
  `harga_beli` varchar(30) NOT NULL,
  `harga_jual` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `uploader` varchar(30) NOT NULL,
  PRIMARY KEY (`id_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `beli`
--
DROP TRIGGER IF EXISTS `beli_barang`;
DELIMITER //
CREATE TRIGGER `beli_barang` AFTER INSERT ON `beli`
 FOR EACH ROW BEGIN
INSERT INTO stok SET
kd_barang = new.kd_barang,qty = new.qty
ON DUPLICATE KEY UPDATE qty = qty + new.qty;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE IF NOT EXISTS `jual` (
  `id_jual` int(10) NOT NULL AUTO_INCREMENT,
  `no_trans` varchar(20) NOT NULL,
  `nama_pembeli` varchar(30) NOT NULL,
  `nama_barang` varchar(30) NOT NULL,
  `kd_barang` varchar(8) NOT NULL,
  `harga_jual` varchar(30) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_harga` varchar(30) NOT NULL,
  `uploader` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_jual`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Triggers `jual`
--
DROP TRIGGER IF EXISTS `total_harga`;
DELIMITER //
CREATE TRIGGER `total_harga` AFTER INSERT ON `jual`
 FOR EACH ROW BEGIN
UPDATE stok SET qty = qty - new.qty
WHERE kd_barang = new.kd_barang;
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE IF NOT EXISTS `pengaturan` (
  `id_jual` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat_perusahaan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_jual`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id_jual`, `nama_perusahaan`, `alamat_perusahaan`) VALUES
(1, 'PT FAJAR SUBHAN', 'JL.Agung Raya,G.Pandawa III,Lenteng Agung');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `kd_barang` varchar(20) NOT NULL,
  `qty` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(30) NOT NULL,
  `email_user` varchar(40) NOT NULL,
  `jabatan_user` varchar(25) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tipe_user` int(2) NOT NULL COMMENT '1=admin,2=user',
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `email_user`, `jabatan_user`, `username`, `password`, `tipe_user`, `tanggal`) VALUES
(1, 'Admin', 'fajar@fajarsubhan.site', 'Web Developer', 'Admin', '$2y$10$P/OTva0.UxuOQzZmgMwzhePOCK0.QdhrsvSZ438WqW7OgoOE3U5JK', 1, '2019-08-26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
