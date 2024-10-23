-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2024 at 02:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktiviti`
--

CREATE TABLE `aktiviti` (
  `idaktiviti` int(11) NOT NULL,
  `nama_aktiviti` varchar(50) NOT NULL,
  `idguru` varchar(50) DEFAULT NULL,
  `masa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aktiviti`
--

INSERT INTO `aktiviti` (`idaktiviti`, `nama_aktiviti`, `idguru`, `masa`) VALUES
(8, 'lompat tali 2', 'admin@gmail.com', '2024-06-05'),
(9, 'jom', 'admin@gmail.com', '2024-06-05'),
(14, 'lompat tinggi', 'admin@gmail.com', '2024-06-12'),
(16, 'larian', 'admin@gmail.com', '2024-07-11'),
(17, 'lompat jauh', 'admin@gmail.com', '2024-08-13');

-- --------------------------------------------------------

--
-- Table structure for table `guru`
--

CREATE TABLE `guru` (
  `idguru` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nombor_telefon` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `guru`
--

INSERT INTO `guru` (`idguru`, `nama`, `password`, `nombor_telefon`) VALUES
('admin@gmail.com', 'superadmin', '123', '012996251'),
('lokehao@gmail.com', 'adminlokehao', '123', '0128976478');

-- --------------------------------------------------------

--
-- Table structure for table `penyertaan`
--

CREATE TABLE `penyertaan` (
  `idpenyertaan` int(11) NOT NULL,
  `idaktiviti` int(11) DEFAULT NULL,
  `idpeserta` varchar(50) DEFAULT NULL,
  `status_kehadiran` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyertaan`
--

INSERT INTO `penyertaan` (`idpenyertaan`, `idaktiviti`, `idpeserta`, `status_kehadiran`) VALUES
(4, 9, 'hao2loke@gmail.com', 'Hadir'),
(6, 8, 'hao2loke@gmail.com', 'Hadir'),
(8, 8, 'rina@hotmail.com', 'Hadir'),
(9, 8, 'shenghao@gmail.com', NULL),
(10, 8, 'hao@gmail.com', NULL),
(11, 9, 'hao@gmail.com', NULL),
(12, 8, 'joshua@gmail.com', NULL),
(14, 14, 'hao@gmail.com', NULL),
(15, 16, 'hao@gmail.com', NULL),
(16, 9, 'rinaatan@yahoo.com', NULL),
(17, 8, 'shenghao234@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `idpeserta` varchar(50) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `nombor_telefon` varchar(50) DEFAULT NULL,
  `idrumahsukan` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`idpeserta`, `nama`, `password`, `nombor_telefon`, `idrumahsukan`) VALUES
('abang@gmail.com', 'name', '123', '01111888742', 2),
('boss@gmail.com', 'boss', '$2y$10$Gk9GGr466ruoscS2LwkzLeOecilwW371rwfa7UUSa6GWSE2uGVTRy', NULL, 5),
('hao2loke@gmail.com', 'justin', '$2y$10$LLiRmyKA7lo0ejpvGoYYhe3LjloEp30C5NQEoR4fODgXiHD0WA9Ju', '01111888742', 3),
('hao@gmail.com', 'lsh', '$2y$10$RyaP0nS.h8QS/laxKxsmHOMrsQJ3C0KR8jJcJNQRATPTcqcqSGsAm', '0127777777', 1),
('helloboss@gmail.com', 'name', '123', '01111888742', 2),
('hi@gmail.com', 'name', '123', '01111888742', 2),
('jfsjakd@gmail.com', 'jjfdsoj', '$2y$10$nEQkj8tSxdiH9heXjo6wcOIXNPS3mzuWRHCSxmIkQG4jILaqOtmbe', NULL, 1),
('joshua@gmail.com', 'joshua', '$2y$10$PMCSzhJ9vCiIi5QTywOLmOKqtgz1hRCjtjibDq83Q3DEwFK0H1js2', NULL, 4),
('rina@hotmail.com', 'rin', '$2y$10$4il90gioN8ow5xHfuZq9ieFH3D3m5sz/vrbbgV7R/s3IFfIH3wB6S', NULL, 5),
('rinaatan@yahoo.com', 'ARISSA', '$2y$10$ybYJJHR3GK67V.jEa4nlhetAlM9LZNEMNQMxfseiReGe0OowcdKSy', NULL, 5),
('shenghao123@gmail.com', 'shenghao123', '$2y$10$ZnvFXInrLCyIMuu1TNY07OGZTVhhdAF/qi9uTeNQM2uM2REzf/Vl6', NULL, 2),
('shenghao234@gmail.com', '123loke', '$2y$10$UagOAe0u6o4udNJf/oXIHeRfm4hAhadxZhyaoOZ4xH4xQKpSgpIfO', NULL, 1),
('shenghao@gmail.com', 'shenghao', '$2y$10$uVoFxXom6Mo2vFLW5W7Fg.8SxWIV/FG.bKbyOyMOT4setMibuZIS2', NULL, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rumahsukan`
--

CREATE TABLE `rumahsukan` (
  `idrumahsukan` int(11) NOT NULL,
  `nama_rumahsukan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rumahsukan`
--

INSERT INTO `rumahsukan` (`idrumahsukan`, `nama_rumahsukan`) VALUES
(1, 'RUBY'),
(2, 'EMERALD'),
(3, 'TOPAZ'),
(4, 'SAPHIRE'),
(5, 'AMETHYST');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktiviti`
--
ALTER TABLE `aktiviti`
  ADD PRIMARY KEY (`idaktiviti`),
  ADD KEY `idguru` (`idguru`);

--
-- Indexes for table `guru`
--
ALTER TABLE `guru`
  ADD PRIMARY KEY (`idguru`);

--
-- Indexes for table `penyertaan`
--
ALTER TABLE `penyertaan`
  ADD PRIMARY KEY (`idpenyertaan`),
  ADD KEY `idaktiviti` (`idaktiviti`),
  ADD KEY `idpeserta` (`idpeserta`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`idpeserta`),
  ADD KEY `idrumahsukan` (`idrumahsukan`);

--
-- Indexes for table `rumahsukan`
--
ALTER TABLE `rumahsukan`
  ADD PRIMARY KEY (`idrumahsukan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktiviti`
--
ALTER TABLE `aktiviti`
  MODIFY `idaktiviti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `penyertaan`
--
ALTER TABLE `penyertaan`
  MODIFY `idpenyertaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rumahsukan`
--
ALTER TABLE `rumahsukan`
  MODIFY `idrumahsukan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aktiviti`
--
ALTER TABLE `aktiviti`
  ADD CONSTRAINT `aktiviti_ibfk_1` FOREIGN KEY (`idguru`) REFERENCES `guru` (`idguru`);

--
-- Constraints for table `penyertaan`
--
ALTER TABLE `penyertaan`
  ADD CONSTRAINT `penyertaan_ibfk_1` FOREIGN KEY (`idaktiviti`) REFERENCES `aktiviti` (`idaktiviti`),
  ADD CONSTRAINT `penyertaan_ibfk_2` FOREIGN KEY (`idpeserta`) REFERENCES `peserta` (`idpeserta`);

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`idrumahsukan`) REFERENCES `rumahsukan` (`idrumahsukan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
