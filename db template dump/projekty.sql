-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2016 at 07:20 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekty`
--

-- --------------------------------------------------------

--
-- Table structure for table `google_users`
--

DROP TABLE IF EXISTS `google_users`;
CREATE TABLE IF NOT EXISTS `google_users` (
  `google_id` decimal(21,0) NOT NULL,
  `google_name` varchar(60) NOT NULL,
  `google_email` varchar(60) NOT NULL,
  `google_link` varchar(60) CHARACTER SET utf8 COLLATE utf8_slovak_ci NOT NULL,
  `google_picture_link` varchar(120) NOT NULL,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pouzivatel`
--

DROP TABLE IF EXISTS `pouzivatel`;
CREATE TABLE IF NOT EXISTS `pouzivatel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `google_id` varchar(21) COLLATE utf8_slovak_ci DEFAULT NULL,
  `email` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(32) COLLATE utf8_slovak_ci DEFAULT NULL COMMENT 'md5 hash hesla',
  `rola` varchar(10) COLLATE utf8_slovak_ci NOT NULL DEFAULT 'uzivatel',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `pouzivatel`
--

INSERT INTO `pouzivatel` (`id`, `google_id`, `email`, `heslo`, `rola`) VALUES
(1, 'NULL', 'admin@test.com', '0192023a7bbd73250516f069df18b500', 'admin'),
(2, 'NULL', 'uzivatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(4, 'NULL', 'uzivatel2@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'uzivatel'),
(6, 'NULL', 'zadavatel@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'zadavatel'),
(7, '105564633106620413434', 'mato.meciar@gmail.com', '', 'uzivatel');

-- --------------------------------------------------------

--
-- Table structure for table `projekt`
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `projekt`
--

INSERT INTO `projekt` (`id`, `nazov`, `popis`, `vytvoril_id`, `skupina_id`, `oblast`, `platforma`, `technologie`, `schvaleny`, `dolezity`, `rok`) VALUES
(1, 'Test project', 'test', 6, -1, 'matematika,fyzika,astronomia', 'windows,unix', 'java,c#,c++', 0, 0, 2016),
(2, 'Test Project 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam in odio aliquam tortor maximus convallis quis ac mauris. Phasellus arcu elit, molestie id varius in, convallis eget odio. Maecenas suscipit sem neque, rhoncus feugiat risus blandit eu. Cras vitae lacus mi. Nulla auctor vitae nisi et pulvinar. Pellentesque nulla ipsum, posuere tincidunt consectetur sit amet, tristique at odio. Sed eu metus rhoncus enim elementum congue nec nec nisl. Quisque odio orci, consectetur non vestibulum et, vehicula ac nisi. Pellentesque at nunc non enim rhoncus pulvinar. Nam odio odio, tincidunt vitae blandit quis, rutrum ac leo. Phasellus sit amet vestibulum arcu. Maecenas imperdiet, arcu at consectetur luctus, justo arcu pellentesque urna, eget molestie tortor sapien at tellus. Proin posuere, nunc utut.', 6, -1, 'matematika,fyzika,informatika', 'windows', 'java,javascript,html', 1, 0, 2016),
(3, 'Admin project', 'admin project description', 1, -1, 'astronomia,fyzika', 'windows', 'c,c++,java', 0, 0, 2016);

-- --------------------------------------------------------

--
-- Table structure for table `skupina`
--

DROP TABLE IF EXISTS `skupina`;
CREATE TABLE IF NOT EXISTS `skupina` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nazov` varchar(100) COLLATE utf8_slovak_ci NOT NULL,
  `email` varchar(120) CHARACTER SET utf32 COLLATE utf32_slovak_ci NOT NULL,
  `veduci_id` int(10) UNSIGNED NOT NULL,
  `schopnosti` text COLLATE utf8_slovak_ci NOT NULL,
  `clenovia` text COLLATE utf8_slovak_ci NOT NULL,
  `preferencie` text COLLATE utf8_slovak_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Dumping data for table `skupina`
--

INSERT INTO `skupina` (`id`, `nazov`, `email`, `veduci_id`, `schopnosti`, `clenovia`, `preferencie`) VALUES
(1, 'Test Group', 'uzivatel@test.com', 2, 'java,javscript,html,css', 'jozo,miso,peto,jano', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
