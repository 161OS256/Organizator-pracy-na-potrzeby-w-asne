-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 11:35 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cigla`
--

-- --------------------------------------------------------

--
-- Table structure for table `agregat`
--

CREATE TABLE `agregat` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `litry` float NOT NULL,
  `motogodz` varchar(20) NOT NULL,
  `mies` varchar(20) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `naczepa` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `austria`
--

CREATE TABLE `austria` (
  `ida` int(11) NOT NULL,
  `data_wj` date DEFAULT NULL,
  `godz_wj` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `data_wy` date DEFAULT NULL,
  `godz_wy` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `uwagi` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `mies` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dane`
--

CREATE TABLE `dane` (
  `id` int(11) NOT NULL,
  `data_start` date DEFAULT NULL,
  `start` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `data_stop` date DEFAULT NULL,
  `stop` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `mies` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `dzien` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `notatka` varchar(700) COLLATE utf8_polish_ci DEFAULT NULL,
  `jazda_10h` tinyint(1) NOT NULL,
  `eu` tinyint(1) NOT NULL,
  `pl` tinyint(1) NOT NULL,
  `uk` tinyint(1) NOT NULL,
  `p9a` tinyint(1) NOT NULL,
  `p9b` tinyint(1) NOT NULL,
  `wekend` varchar(1) COLLATE utf8_polish_ci NOT NULL DEFAULT '0',
  `wekend_dom` tinyint(1) NOT NULL,
  `przestoj` tinyint(1) NOT NULL,
  `przestoj_dom` tinyint(1) NOT NULL,
  `pauza_3h` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `francja`
--

CREATE TABLE `francja` (
  `idf` int(11) NOT NULL,
  `data_wj` date DEFAULT NULL,
  `godz_wj` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `data_wy` date DEFAULT NULL,
  `godz_wy` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `uwagi` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `mies` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kasa`
--

CREATE TABLE `kasa` (
  `id` int(11) NOT NULL,
  `pl` float NOT NULL DEFAULT 0,
  `stan_pl` float NOT NULL DEFAULT 0,
  `eu` float NOT NULL DEFAULT 0,
  `stan_eu` float NOT NULL DEFAULT 0,
  `uk` float NOT NULL DEFAULT 0,
  `stan_uk` float NOT NULL DEFAULT 0,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `niemcy`
--

CREATE TABLE `niemcy` (
  `idn` int(11) NOT NULL,
  `data_wj` date DEFAULT NULL,
  `godz_wj` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `data_wy` date DEFAULT NULL,
  `godz_wy` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `uwagi` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `mies` varchar(20) COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oddawanie`
--

CREATE TABLE `oddawanie` (
  `id` int(11) NOT NULL,
  `data_start` date DEFAULT NULL,
  `godz_start` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `data_stop` date DEFAULT NULL,
  `godz_stop` varchar(5) COLLATE utf8_polish_ci DEFAULT NULL,
  `do_oddania` smallint(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `oddawanie`
--

INSERT INTO `oddawanie` (`id`, `data_start`, `godz_start`, `data_stop`, `godz_stop`, `do_oddania`) VALUES
(3, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL),
(1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `palety`
--

CREATE TABLE `palety` (
  `idp` int(11) NOT NULL,
  `data` date NOT NULL,
  `miejsce` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `zdane` smallint(6) NOT NULL,
  `pobrane` smallint(6) NOT NULL,
  `stan` smallint(6) NOT NULL,
  `uwagi` varchar(200) COLLATE utf8_polish_ci NOT NULL,
  `moje` smallint(2) NOT NULL,
  `podpis` mediumtext COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `id_inne` tinyint(4) NOT NULL DEFAULT 1,
  `id` int(11) NOT NULL,
  `data_start` date NOT NULL,
  `data2` date NOT NULL,
  `data3` date NOT NULL,
  `data4` date NOT NULL,
  `dzien` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `mies` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `mies2` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `godz_start` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `min_start` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `godz_stop` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `min_stop` varchar(4) COLLATE utf8_polish_ci NOT NULL,
  `zdane` smallint(6) NOT NULL,
  `pobrane` smallint(6) NOT NULL,
  `usun` varchar(1) COLLATE utf8_polish_ci NOT NULL,
  `data_oddania` date NOT NULL,
  `data_tygodnia` date NOT NULL,
  `godz_tygodnia` varchar(5) COLLATE utf8_polish_ci NOT NULL,
  `test` tinyint(1) NOT NULL,
  `kolor` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `zp` smallint(1) NOT NULL,
  `infowik` smallint(1) NOT NULL,
  `naczepa` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `miejsce` varchar(20) COLLATE utf8_polish_ci NOT NULL,
  `ost` date NOT NULL,
  `idp` int(11) NOT NULL,
  `ok` tinyint(1) NOT NULL,
  `os` tinyint(1) NOT NULL,
  `ost_idp` int(11) NOT NULL,
  `ost_idk` int(11) NOT NULL,
  `id_zmien` tinyint(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`id_inne`, `id`, `data_start`, `data2`, `data3`, `data4`, `dzien`, `mies`, `mies2`, `godz_start`, `min_start`, `godz_stop`, `min_stop`, `zdane`, `pobrane`, `usun`, `data_oddania`, `data_tygodnia`, `godz_tygodnia`, `test`, `kolor`, `zp`, `infowik`, `naczepa`, `miejsce`, `ost`, `idp`, `ok`, `os`, `ost_idp`, `ost_idk`, `id_zmien`) VALUES
(1, 1, '2025-03-28', '2021-05-19', '2021-05-19', '2025-03-28', 'Piątek', 'Marzec', 'Marzec', '12', '31', '21', '24', 0, 0, '0', '2021-05-13', '2021-05-17', '16:34', 0, 'gray', 1, 0, 'XX1234', 'Barsinghausen', '2021-05-04', 459, 0, 0, 453, 128, 17);

-- --------------------------------------------------------

--
-- Table structure for table `terminy`
--

CREATE TABLE `terminy` (
  `id` tinyint(4) NOT NULL,
  `nazwa` varchar(50) CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `terminy`
--

INSERT INTO `terminy` (`id`, `nazwa`, `data`) VALUES
(26, 'test', '2026-03-28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agregat`
--
ALTER TABLE `agregat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `austria`
--
ALTER TABLE `austria`
  ADD PRIMARY KEY (`ida`);

--
-- Indexes for table `dane`
--
ALTER TABLE `dane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `francja`
--
ALTER TABLE `francja`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `kasa`
--
ALTER TABLE `kasa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `niemcy`
--
ALTER TABLE `niemcy`
  ADD PRIMARY KEY (`idn`);

--
-- Indexes for table `oddawanie`
--
ALTER TABLE `oddawanie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `palety`
--
ALTER TABLE `palety`
  ADD PRIMARY KEY (`idp`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`id_inne`);

--
-- Indexes for table `terminy`
--
ALTER TABLE `terminy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agregat`
--
ALTER TABLE `agregat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `austria`
--
ALTER TABLE `austria`
  MODIFY `ida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `dane`
--
ALTER TABLE `dane`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=621;

--
-- AUTO_INCREMENT for table `francja`
--
ALTER TABLE `francja`
  MODIFY `idf` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `kasa`
--
ALTER TABLE `kasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `niemcy`
--
ALTER TABLE `niemcy`
  MODIFY `idn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=311;

--
-- AUTO_INCREMENT for table `oddawanie`
--
ALTER TABLE `oddawanie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `palety`
--
ALTER TABLE `palety`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT for table `terminy`
--
ALTER TABLE `terminy`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
