-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 04, 2025 at 01:50 PM
-- Server version: 5.7.25
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_spk_fuzzy-mamdani`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jenis` enum('input','output') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `nama`, `jenis`) VALUES
(1, 'Banyak Pakaian', 'input'),
(2, 'Tingkat Kotoran', 'input'),
(3, 'Kecepatan Putar', 'output');

-- --------------------------------------------------------

--
-- Table structure for table `tb_rule`
--

CREATE TABLE `tb_rule` (
  `id_rule` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_skala` int(11) DEFAULT NULL,
  `kondisi` enum('if','then') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_rule`
--

INSERT INTO `tb_rule` (`id_rule`, `id_kriteria`, `id_skala`, `kondisi`) VALUES
(1, 1, 1, 'if'),
(2, 2, 3, 'if'),
(3, 3, 6, 'then'),
(4, 1, 1, 'if'),
(5, 2, 4, 'if'),
(6, 3, 6, 'then'),
(7, 1, 1, 'if'),
(8, 2, 5, 'if'),
(9, 3, 7, 'then'),
(10, 1, 2, 'if'),
(11, 2, 3, 'if'),
(12, 3, 6, 'then'),
(13, 1, 2, 'if'),
(14, 2, 4, 'if'),
(15, 3, 7, 'then'),
(16, 1, 2, 'if'),
(17, 2, 5, 'if'),
(18, 3, 7, 'then');

-- --------------------------------------------------------

--
-- Table structure for table `tb_skala`
--

CREATE TABLE `tb_skala` (
  `id_skala` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `batas_bawah` float DEFAULT NULL,
  `batas_tengah` float DEFAULT NULL,
  `batas_atas` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_skala`
--

INSERT INTO `tb_skala` (`id_skala`, `id_kriteria`, `nama`, `batas_bawah`, `batas_tengah`, `batas_atas`) VALUES
(1, 1, 'Sedikit', 40, 80, NULL),
(2, 1, 'Banyak', NULL, 40, 80),
(3, 2, 'Rendah', 10, 40, NULL),
(4, 2, 'Sedang', 40, 50, 60),
(5, 2, 'Tinggi', NULL, 50, 60),
(6, 3, 'Lambat', 500, 1200, NULL),
(7, 3, 'Cepat', NULL, 500, 1200);

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE `tb_users` (
  `id` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `nama` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` enum('admin','users') COLLATE utf8mb4_unicode_ci NOT NULL,
  `ins` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `id_users`, `nama`, `email`, `foto`, `username`, `password`, `roles`, `ins`, `upd`) VALUES
(1, 1, 'Alan Saputra Lengkoan', 'alanlengkoan@example.com', NULL, 'admin', '$2y$10$UrvEbnhpVkCREvEz1WjUAu5EUEdbeTjFtQE0faPjufKxl68AtJmsi', 'admin', '2021-07-21 17:56:34', '2025-04-27 02:41:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  ADD PRIMARY KEY (`id_kriteria`) USING BTREE;

--
-- Indexes for table `tb_rule`
--
ALTER TABLE `tb_rule`
  ADD PRIMARY KEY (`id_rule`) USING BTREE,
  ADD KEY `kriteria_to_rule` (`id_kriteria`),
  ADD KEY `skala_to_rule` (`id_skala`);

--
-- Indexes for table `tb_skala`
--
ALTER TABLE `tb_skala`
  ADD PRIMARY KEY (`id_skala`) USING BTREE,
  ADD KEY `kriteria_to_skala` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kriteria`
--
ALTER TABLE `tb_kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_rule`
--
ALTER TABLE `tb_rule`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tb_skala`
--
ALTER TABLE `tb_skala`
  MODIFY `id_skala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_rule`
--
ALTER TABLE `tb_rule`
  ADD CONSTRAINT `kriteria_to_rule` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`),
  ADD CONSTRAINT `skala_to_rule` FOREIGN KEY (`id_skala`) REFERENCES `tb_skala` (`id_skala`);

--
-- Constraints for table `tb_skala`
--
ALTER TABLE `tb_skala`
  ADD CONSTRAINT `kriteria_to_skala` FOREIGN KEY (`id_kriteria`) REFERENCES `tb_kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
