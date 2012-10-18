-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 18, 2012 at 10:41 AM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ems`
--
CREATE DATABASE `ems` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `ems`;

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE IF NOT EXISTS `assignment` (
  `crew_id` varchar(40) NOT NULL,
  `assignment_id` int(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`crew_id`, `assignment_id`) VALUES
('E-001', 38),
('E-003', 21),
('E-001', 36),
('E-001', 32),
('E-001', 20),
('E-001', 22),
('E-001', 34),
('E-001', 48),
('E-001', 13),
('E-001', 46),
('E-001', 47),
('E-004', 45),
('E-001', 11),
('E-004', 44),
('E-004', 26),
('E-003', 39);

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE IF NOT EXISTS `crew` (
  `cid` varchar(20) NOT NULL,
  `cname` varchar(40) NOT NULL,
  `ceadd` varchar(40) NOT NULL,
  `caddress` varchar(40) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`cid`, `cname`, `ceadd`, `caddress`) VALUES
('E-003', 'Kenshin Himura', 'himura.kenshin@gmail.com', 'Japan'),
('E-004', 'Obladi Oblada', 'obladi.oblada@rocketmail.com', 'Iligan City'),
('E-005', 'Erika Strider', 'erika.strider@hotmail.com', 'Iligan City'),
('E-001', 'John Smith', 'john_smith@yahoo.com', 'Iligan City');

-- --------------------------------------------------------

--
-- Table structure for table `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `id` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisor`
--

INSERT INTO `supervisor` (`id`, `name`, `username`, `password`, `address`) VALUES
('12345', 'Altair Ibn-La''Ahad ', 'altair', 'poisondart', 'Syria'),
('123456', 'Ezio Auditoire de Firenze', 'ezio_auditore', 'auditore', 'Italy');

-- --------------------------------------------------------

--
-- Table structure for table `workload`
--

CREATE TABLE IF NOT EXISTS `workload` (
  `wid` int(20) NOT NULL AUTO_INCREMENT,
  `wdescription` varchar(50) NOT NULL,
  `wclient` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `wtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `wstatus` varchar(9) NOT NULL DEFAULT 'AVAILABLE',
  PRIMARY KEY (`wid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `workload`
--

INSERT INTO `workload` (`wid`, `wdescription`, `wclient`, `wtime`, `wstatus`) VALUES
(11, 'asdf', 'asdf', '2012-03-25 18:27:05', 'ASSIGNED'),
(13, 'asdf asdf', 'asdf asdf', '2012-03-25 18:28:33', 'ASSIGNED'),
(16, 'Reformat', 'Uzumaki Naruto', '2012-03-19 00:00:00', 'AVAILABLE'),
(19, 'asdf-asdf', 'asdf-asdf', '2012-03-25 21:21:06', 'AVAILABLE'),
(20, 'asdf.asdf', 'asdf.asdf', '2012-03-19 00:00:00', 'ASSIGNED'),
(21, 'asdf`asdf', 'asdf`asdf', '2012-03-19 00:00:00', 'ASSIGNED'),
(22, 'asdf"asdf', 'asdf"asdf', '2012-03-25 18:28:33', 'ASSIGNED'),
(23, '1234', '1234', '2012-03-19 00:00:00', 'AVAILABLE'),
(26, 'achmed', 'achmed', '2012-03-25 18:28:33', 'ASSIGNED'),
(33, 'Desktop Repair', 'New Client', '2012-03-19 01:23:45', 'AVAILABLE'),
(32, 'maintenance', 'crowns way', '2012-03-25 18:28:33', 'ASSIGNED'),
(34, 'Assassinate', 'Altair Ibn-La`Ahad', '2012-03-25 18:28:33', 'ASSIGNED'),
(35, 'Pizza Delivery', 'Pizza Man', '2012-03-20 00:00:00', 'AVAILABLE'),
(36, 'Burger and Fries', 'Burger and Fries Man', '2012-03-25 18:28:33', 'ASSIGNED'),
(38, 'computer reformat', 'unknown', '2012-03-25 18:28:33', 'ASSIGNED'),
(39, 'aa123', 'qos', '2012-03-25 18:28:33', 'ASSIGNED'),
(40, 'qwerty', 'qwerty', '2012-03-23 00:00:00', 'AVAILABLE'),
(41, 'qwerty2', 'unknown2', '2012-03-23 00:00:00', 'AVAILABLE'),
(42, 'Trolling', 'Shadow Strider', '2012-03-25 21:21:06', 'AVAILABLE'),
(44, 'asasasa', 'dasf', '2012-03-30 00:00:00', 'ASSIGNED'),
(45, 'Cleaning', 'The Cleaner', '2012-04-03 12:35:56', 'ASSIGNED'),
(46, 'TEST', 'TEST', '2012-06-02 00:00:00', 'ASSIGNED'),
(47, 'TEST2', 'TEST2', '2012-06-02 00:00:00', 'ASSIGNED'),
(48, 'x', 'y', '0000-00-00 00:00:00', 'ASSIGNED'),
(49, 'x', 'y', '2012-09-27 12:34:56', 'AVAILABLE'),
(50, 'x', 'y', '2012-09-27 12:34:56', 'AVAILABLE'),
(51, 'ACHMED', 'ACH', '2012-09-28 12:34:56', 'AVAILABLE'),
(52, 'add', 'add', '2012-09-28 12:34:56', 'AVAILABLE'),
(53, 'add', 'add', '2012-09-28 00:00:00', 'AVAILABLE'),
(54, 'adx', 'ady', '2012-09-28 00:00:00', 'AVAILABLE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
