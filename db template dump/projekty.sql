-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 04.Apr 2016, 09:21
-- Verzia serveru: 5.7.9
-- Verzia PHP: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `projekty`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pouzivatel`
--

DROP TABLE IF EXISTS `pouzivatel`;
CREATE TABLE IF NOT EXISTS `pouzivatel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(32) COLLATE utf8_slovak_ci NOT NULL COMMENT 'md5 hash hesla',
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'uzivatel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `pouzivatel`
--

INSERT INTO `pouzivatel` (`id`, `email`, `heslo`, `rola`) VALUES
(1, 'test@test.com', '52dcb810931e20f7aa2f49b3510d3805', 'admin'),
(2, 'uzivatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(4, 'uzivatel2@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(6, 'zadavatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `projekt`
--

DROP TABLE IF EXISTS `projekt`;
CREATE TABLE IF NOT EXISTS `projekt` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `popis` text COLLATE utf8_slovak_ci NOT NULL,
  `vytvoril_id` int(11) NOT NULL,
  `skupina_id` int(11) NOT NULL DEFAULT '-1',
  `oblast` text COLLATE utf8_slovak_ci NOT NULL,
  `platforma` text COLLATE utf8_slovak_ci NOT NULL,
  `technologie` text COLLATE utf8_slovak_ci NOT NULL,
  `schvaleny` tinyint(1) NOT NULL DEFAULT '0',
  `dolezity` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `rok` smallint(5) UNSIGNED NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `projekt`
--

INSERT INTO `projekt` (`id`, `nazov`, `popis`, `vytvoril_id`, `skupina_id`, `oblast`, `platforma`, `technologie`, `schvaleny`, `dolezity`, `rok`) VALUES
(1, 'Test project', 'test', 6, -1, 'matematika,fyzika,astronomia', 'windows,unix', 'java,c#,c++', 0, 0, 2016);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `skupina`
--

DROP TABLE IF EXISTS `skupina`;
CREATE TABLE IF NOT EXISTS `skupina` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf32 COLLATE utf32_slovak_ci NOT NULL,
  `veduci_id` int(10) UNSIGNED NOT NULL,
  `schopnosti` text COLLATE utf8_slovak_ci NOT NULL,
  `clenovia` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
