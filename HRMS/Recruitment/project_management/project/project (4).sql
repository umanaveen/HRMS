-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2021 at 04:13 AM
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
-- Database: `hrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `project_timeline` date NOT NULL,
  `no_of_working_hours` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `client`, `project_name`, `project_timeline`, `no_of_working_hours`) VALUES
(11, '2', 'HRMS', '2021-06-18', 8),
(1, 'Gokila', 'project management', '2021-06-18', 8),
(12, '2', 'HRMS', '2021-06-18', 8),
(13, '2', 'HRMS', '2021-06-18', 8),
(14, '1', 'Project Management', '2021-06-18', 4),
(15, '2', 'HRMS', '2021-06-18', 16),
(16, '1', 'Project Management', '2021-06-18', 4),
(17, '1', 'Project Management', '2021-06-18', 8),
(18, '2', 'Project Management', '2021-06-18', 4),
(19, '1', 'HRMS', '2021-06-18', 4),
(20, '2', 'Project Management', '2021-06-18', 8),
(21, '1', 'Project Management', '2021-06-18', 8),
(22, '2', 'Project To Do List', '2021-06-18', 8);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
