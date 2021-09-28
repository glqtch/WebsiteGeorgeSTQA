-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2021 at 06:36 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `am1x-vegetablejuice-c2019`
--
DROP DATABASE IF EXISTS `am1x-vegetablejuice-c2019`;
CREATE DATABASE IF NOT EXISTS `am1x-vegetablejuice-c2019` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `am1x-vegetablejuice-c2019`;

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(300) NOT NULL,
  `password` varchar(60) NOT NULL,
  `userrole` enum('root','admin','customer','moderator') NOT NULL,
  `activated` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `email`, `password`, `userrole`, `activated`) VALUES
(2, 'adruijter@gmail.com', '$2y$10$eoAd9qFVz4dvr7u3OD2Te.r3BFI7xhJCid823h8yOyHbf1HSoqPTe', 'customer', 0),
(3, 'rra@mboutrecht.nl', '$2y$10$SDPRaGXfY2/pRp/MYAdUX.NYHMxaGh1hGBSm9k9YUDy1dcRynETXC', 'customer', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
