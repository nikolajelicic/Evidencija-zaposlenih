-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 04, 2020 at 06:45 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evidencija_zaposlenih`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `idadmin` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`idadmin`),
  UNIQUE KEY `idadmin_UNIQUE` (`idadmin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `email`, `password`) VALUES
(1, 'admin@admin.com', 'admin1234');

-- --------------------------------------------------------

--
-- Table structure for table `kutije`
--

DROP TABLE IF EXISTS `kutije`;
CREATE TABLE IF NOT EXISTS `kutije` (
  `idkutije` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `dimenzija_kutije` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `cena` int(4) DEFAULT NULL,
  PRIMARY KEY (`idkutije`),
  UNIQUE KEY `idkutije_UNIQUE` (`idkutije`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `kutije`
--

INSERT INTO `kutije` (`idkutije`, `dimenzija_kutije`, `cena`) VALUES
(1, '100x200x200', 41),
(2, '200x200x200', 55),
(3, '400x300x300', 70),
(4, '500x500x500', 90),
(5, '1500x1000x1000', 301),
(49, '350x320x200', 70),
(51, '500x200x100', 92);

-- --------------------------------------------------------

--
-- Table structure for table `plata`
--

DROP TABLE IF EXISTS `plata`;
CREATE TABLE IF NOT EXISTS `plata` (
  `idplata` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `visina_plate` int(11) DEFAULT NULL,
  `mesec` varchar(10) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `godina` int(4) DEFAULT NULL,
  `users_idusers` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idplata`),
  UNIQUE KEY `idplata_UNIQUE` (`idplata`),
  KEY `fk_plata_users1_idx` (`users_idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `plata`
--

INSERT INTO `plata` (`idplata`, `visina_plate`, `mesec`, `godina`, `users_idusers`) VALUES
(8, 55000, ' januar', 2020, 8),
(9, 57500, ' januar', 2020, 9),
(10, 50000, ' januar', 2020, 10),
(11, 50000, ' februar', 2020, 8),
(12, 50000, ' februar', 2020, 9),
(13, 50000, ' mart', 2020, 9),
(16, 50000, ' mart', 2020, 10),
(17, 50000, ' mart', 2020, 8),
(18, 51000, ' februar', 2020, 10),
(19, 48400, ' januar', 2020, 28),
(20, 30000, ' januar', 2020, 29),
(22, 44000, ' januar', 2020, 31),
(23, 66900, ' februar', 2020, 34),
(24, 48400, ' februar', 2020, 28),
(25, 48400, ' mart', 2020, 28),
(26, 30000, ' februar', 2020, 29),
(27, 30000, ' mart', 2020, 29),
(28, 44000, ' februar', 2020, 31),
(29, 44440, ' mart', 2020, 31),
(30, 50600, ' januar', 2020, 32),
(31, 51290, ' februar', 2020, 32),
(32, 50600, ' mart', 2020, 32),
(33, 66000, ' januar', 2020, 34),
(35, 72000, ' mart', 2020, 34);

-- --------------------------------------------------------

--
-- Table structure for table `radni_sati`
--

DROP TABLE IF EXISTS `radni_sati`;
CREATE TABLE IF NOT EXISTS `radni_sati` (
  `idradni_sati` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesec` varchar(10) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `godina` int(4) DEFAULT NULL,
  `broj_sati` int(2) DEFAULT NULL,
  `users_idusers` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idradni_sati`),
  UNIQUE KEY `idradni_sati_UNIQUE` (`idradni_sati`),
  KEY `fk_radni_sati_users1_idx` (`users_idusers`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `radni_sati`
--

INSERT INTO `radni_sati` (`idradni_sati`, `mesec`, `godina`, `broj_sati`, `users_idusers`) VALUES
(8, 'januar', 2020, 220, 8),
(9, 'januar', 2020, 230, 9),
(10, 'januar', 2020, 200, 10),
(19, 'februar', 2020, 200, 8),
(20, 'februar', 2020, 200, 9),
(21, 'februar', 2020, 204, 10),
(30, 'mart', 2020, 200, 8),
(31, 'mart', 2020, 200, 9),
(32, 'mart', 2020, 200, 10),
(33, 'januar', 2020, 220, 28),
(34, 'januar', 2020, 200, 29),
(36, 'januar', 2020, 200, 31),
(37, 'januar', 2020, 220, 32),
(45, 'januar', 2020, 220, 34),
(46, 'februar', 2020, 220, 28),
(47, 'februar', 2020, 200, 29),
(49, 'februar', 2020, 200, 31),
(50, 'februar', 2020, 223, 32),
(52, 'februar', 2020, 223, 34),
(53, 'mart', 2020, 220, 28),
(54, 'mart', 2020, 200, 29),
(56, 'mart', 2020, 202, 31),
(57, 'mart', 2020, 220, 32),
(59, 'mart', 2020, 240, 34),
(108, 'januar', 49, 221, 49),
(109, 'februar', 49, 221, 49),
(110, 'mart', 49, 203, 49),
(111, 'april', 49, 192, 49);

-- --------------------------------------------------------

--
-- Table structure for table `radno_mesto`
--

DROP TABLE IF EXISTS `radno_mesto`;
CREATE TABLE IF NOT EXISTS `radno_mesto` (
  `idradno_mesto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `naziv_radnog_mesta` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `cena_radnog_sata` int(4) DEFAULT NULL,
  PRIMARY KEY (`idradno_mesto`),
  UNIQUE KEY `idradno_mesto_UNIQUE` (`idradno_mesto`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `radno_mesto`
--

INSERT INTO `radno_mesto` (`idradno_mesto`, `naziv_radnog_mesta`, `cena_radnog_sata`) VALUES
(1, 'Cuvar', 150),
(2, 'Fizikalac', 200),
(3, 'Magacioner', 220),
(4, 'Majstor', 230),
(5, 'Operater za masinom', 250),
(6, 'Sef', 300),
(7, 'Poslovodja', 310),
(8, 'Viljuskarista', 240);

-- --------------------------------------------------------

--
-- Table structure for table `uradjeno`
--

DROP TABLE IF EXISTS `uradjeno`;
CREATE TABLE IF NOT EXISTS `uradjeno` (
  `iduradjeno` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `mesec` varchar(10) COLLATE utf8_slovenian_ci NOT NULL,
  `godina` int(4) NOT NULL,
  `komada` int(4) NOT NULL,
  `kutije_idkutije` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`iduradjeno`),
  UNIQUE KEY `iduradjeno_UNIQUE` (`iduradjeno`),
  KEY `fk_uradjeno_kutije1_idx` (`kutije_idkutije`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `uradjeno`
--

INSERT INTO `uradjeno` (`iduradjeno`, `mesec`, `godina`, `komada`, `kutije_idkutije`) VALUES
(1, 'januar', 2020, 10000, 3),
(2, 'januar', 2020, 6000, 1),
(3, 'januar', 2020, 500, 2),
(4, 'januar', 2020, 6000, 4),
(6, 'januar', 2020, 6000, 5),
(9, 'februar', 2020, 1000, 1),
(10, 'februar', 2020, 2000, 2),
(11, 'februar', 2020, 5000, 3),
(12, 'februar', 2020, 6000, 4),
(13, 'februar', 2020, 6000, 5),
(16, 'mart', 2020, 5000, 3),
(17, 'mart', 2020, 6000, 4),
(18, 'mart', 2020, 6000, 5),
(21, 'april', 2020, 5000, 3),
(22, 'april', 2020, 6000, 4),
(23, 'april', 2020, 6000, 5),
(26, 'maj', 2020, 5000, 3),
(27, 'maj', 2020, 6000, 4),
(28, 'maj', 2020, 6000, 5),
(31, 'maj', 2020, 10000, 5),
(32, 'maj', 2020, 10000, 1),
(33, 'maj', 2020, 1000, 2),
(34, 'maj', 2020, 6000, 3),
(35, 'maj', 2020, 5000, 4),
(41, 'april', 2020, 11000, 1),
(42, 'avgust', 2020, 222, 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idusers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ime` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `prezime` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `sifra` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `radno_mesto_idradno_mesto` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`idusers`),
  UNIQUE KEY `idusers_UNIQUE` (`idusers`),
  KEY `fk_users_radno_mesto1_idx` (`radno_mesto_idradno_mesto`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idusers`, `ime`, `prezime`, `email`, `sifra`, `radno_mesto_idradno_mesto`) VALUES
(8, 'Sava', 'Savic', 'sava@gmail.com', 'c2F2YTE=', 5),
(9, 'Nikola', 'Nikolic', 'nikolaN@gmail.com', 'bmlrb2xhTjEyMQ==', 5),
(10, 'Slobodan', 'Vasic', 'slobodan@gmail.com', 'c2xvYmFWYWFhYWFhYQ==', 5),
(28, 'Milos', 'Milosevic', 'milos@gmail.com', 'bWlsb3MxMg==', 3),
(29, 'Djordje', 'Vasic', 'djordje@gmail.com', 'ZGpvcmRqZQ==', 1),
(31, 'Bogoljub', 'Savic', 'bsavic@gmail.com', 'Ym9nb2xqdWJTYXZpYzEx', 3),
(32, 'Marinko', 'Marinkovic', 'marinko@gmail.com', 'bWFyaW5rbw==', 4),
(34, 'Dejan', 'Dejanovic', 'deki@gmail.com', 'ZGVqYW5EZWphbm92aWMzMDA=', 6),
(41, 'Dordje', 'Tesic', 'djordje3@gmail.com', 'ZGpvbGUxMjM=', 2),
(42, 'Mile', 'Miletic', 'mile@gmail.com', 'bWlsZQ==', 2),
(43, 'Marija', 'Markovic', 'marija1@gmail.com', 'bWFyaWphMTIz', 6),
(45, 'Zeljko', 'Mirkovic', 'mirkovic@gmail.com', 'bWlya292aWMxMjM0', 7),
(49, 'Nikola', 'Jelicic', 'nikolajelicic@gmail.com', 'bmlrb2xhamVsaWNpYw==', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plata`
--
ALTER TABLE `plata`
  ADD CONSTRAINT `fk_plata_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `radni_sati`
--
ALTER TABLE `radni_sati`
  ADD CONSTRAINT `fk_radni_sati_users1` FOREIGN KEY (`users_idusers`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uradjeno`
--
ALTER TABLE `uradjeno`
  ADD CONSTRAINT `fk_uradjeno_kutije1` FOREIGN KEY (`kutije_idkutije`) REFERENCES `kutije` (`idkutije`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_radno_mesto1` FOREIGN KEY (`radno_mesto_idradno_mesto`) REFERENCES `radno_mesto` (`idradno_mesto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
