-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2017 at 12:59 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cssd`
--

-- --------------------------------------------------------

--
-- Table structure for table `instrumen`
--

CREATE TABLE `instrumen` (
  `id_instrumen` varchar(5) NOT NULL,
  `nama_instrumen` varchar(50) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `steril` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instrumen`
--

INSERT INTO `instrumen` (`id_instrumen`, `nama_instrumen`, `jumlah`, `steril`) VALUES
('GUN01', 'GUNTING KECIL', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjam` varchar(18) NOT NULL,
  `id_instrumen` varchar(5) NOT NULL,
  `jumlah_pinjam` int(3) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `status_peminjaman` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(8) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(26) NOT NULL,
  `no_telepon` varchar(20) NOT NULL,
  `status_user` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `password`, `no_telepon`, `status_user`) VALUES
('admin', 'admin_simrs', 'admin', '', 0),
('CSSD1', 'Imam Dwicahya', 'cssd1', '0', 1),
('I01', 'Leo Krisnoto', 'I01', '0', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instrumen`
--
ALTER TABLE `instrumen`
  ADD PRIMARY KEY (`id_instrumen`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
