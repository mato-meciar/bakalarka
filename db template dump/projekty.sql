-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2016 at 12:32 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projekty`
--

-- --------------------------------------------------------

--
-- Table structure for table `pouzivatel`
--

CREATE TABLE IF NOT EXISTS `pouzivatel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(32) COLLATE utf8_slovak_ci NOT NULL COMMENT 'md5 hash hesla',
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'uzivatel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pouzivatel`
--

INSERT INTO `pouzivatel` (`id`, `email`, `heslo`, `rola`) VALUES
(1, 'test@test.com', '52dcb810931e20f7aa2f49b3510d3805', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `projekt`
--

CREATE TABLE IF NOT EXISTS `projekt` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `popis` text COLLATE utf8_slovak_ci NOT NULL,
  `vytvoril_id` int(11) NOT NULL,
  `skupina_id` int(11) DEFAULT NULL,
  `klucove_slova` text COLLATE utf8_slovak_ci NOT NULL,
  `schvaleny` tinyint(1) NOT NULL DEFAULT '0',
  `rok` smallint(5) unsigned NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

CREATE TABLE IF NOT EXISTS `skupina` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf32 COLLATE utf32_slovak_ci NOT NULL,
  `veduci_id` int(10) unsigned NOT NULL,
  `schopnosti` text COLLATE utf8_slovak_ci NOT NULL,
  `clenovia` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
