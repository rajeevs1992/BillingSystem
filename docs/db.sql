-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 10, 2012 at 08:45 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `slNo` int(11) DEFAULT NULL,
  `mrp` float DEFAULT NULL,
  `PplusT` float DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unitPrice` float DEFAULT NULL,
  `rateOfTax` float DEFAULT NULL,
  `taxAmt` float DEFAULT NULL,
  `cess` float DEFAULT NULL,
  `total` float DEFAULT NULL,
  `billNo` varchar(10) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`slNo`, `mrp`, `PplusT`, `name`, `code`, `qty`, `unitPrice`, `rateOfTax`, `taxAmt`, `cess`, `total`, `billNo`, `user`) VALUES
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 10, 9.61, 4, 3.844, 0.004, 99.94, '1', 'rajeev'),
(2, 10, 12.48, 'Pen', 'abc', 1, 12, 4, 0.48, 0.005, 12.48, '1', 'rajeev'),
(1, 150, 148, 'BSD', 'absd', 8, 148, 0, 0, 0, 1184, '2', 'rajeev'),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 1, 9.61, 4, 0.384, 0.004, 9.994, '3', 'rajeev'),
(2, 150, 148, 'BSD', 'absd', 8, 148, 0, 0, 0, 1184, '3', 'rajeev'),
(3, 0, 119.954, 'Box Sigma Instrument', 'b010', 1, 115.34, 4, 4.614, 0.046, 119.954, '3', 'rajeev'),
(1, 10, 12.12, 'Pen', 'abc', 1, 12, 5, 0.12, NULL, 12.12, '4', 'rajeev'),
(2, 0, 9.706, 'Book-Theodolite field book', 'b008', 1, 9.61, 5, 0.096, NULL, 9.706, '4', 'rajeev'),
(1, 0, 121.11, 'Box Sigma Instrument', 'b010', 12, 115.34, 5, 69.2, NULL, 1453.32, '5', 'rajeev'),
(2, 0, 5.04, 'Arrows', 'a003', 1, 4.44, 13.5, 0.6, NULL, 5.04, '5', 'rajeev');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `code` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mrp` float DEFAULT NULL,
  `unitPrice` float DEFAULT NULL,
  `rateOfTax` float DEFAULT NULL,
  `sellingPrice` float DEFAULT NULL,
  `purchasingPrice` float DEFAULT NULL,
  `profitPerUnit` float DEFAULT NULL,
  `totalStock` int(11) DEFAULT NULL,
  `openingStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`code`, `name`, `mrp`, `unitPrice`, `rateOfTax`, `sellingPrice`, `purchasingPrice`, `profitPerUnit`, `totalStock`, `openingStock`) VALUES
('b008', 'Book-Theodolite field book', NULL, 9.61, 1, 10, 8, 10, 1, 287),
('a003', 'Arrows', NULL, 4.44, 2, 5, NULL, 5, 9, 15),
('b010', 'Box Sigma Instrument', NULL, 115.34, 1, 120, NULL, 120, 81, 149),
('b0081', 'Pen1', 10, 9.61, 1, 9.994, 12, -2.006, 14, 0),
('absd', 'BSD', 150, 148, 0, 148, 145, 3, 4, 0),
('abc', 'Pen', 10, 12, 1, 12.48, 12, 0.48, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `code` varchar(10) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--


-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `billNo` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `salesNonTax` float DEFAULT NULL,
  `tax1sales` float DEFAULT NULL,
  `tax2sales` float DEFAULT NULL,
  `tax1` float DEFAULT NULL,
  `tax2` float DEFAULT NULL,
  `totalWithoutTax` float DEFAULT NULL,
  `cashOrCredit` char(2) DEFAULT NULL,
  PRIMARY KEY (`billNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`billNo`, `date`, `salesNonTax`, `tax1sales`, `tax2sales`, `tax1`, `tax2`, `totalWithoutTax`, `cashOrCredit`) VALUES
('1', '2012-06-09', 0, 112.42, 0, 4.324, 0, 112.42, 'C'),
('2', '2012-06-09', 1184, 0, 0, 0, 0, 1184, 'C'),
('3', '2012-06-09', 1184, 129.948, 0, 4.998, 0, 1313.95, 'C'),
('4', '2012-06-09', 0, 21.826, 0, 0.216, 0, 21.826, 'C'),
('5', '2012-06-09', 0, 1453.32, 5.04, 69.2, 0.6, 1458.36, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE IF NOT EXISTS `temp` (
  `tempBillNo` int(11) DEFAULT NULL,
  `code` varchar(5) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `Date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(25) NOT NULL,
  `passwd` varchar(40) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `acessLevel` int(1) DEFAULT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `passwd`, `email`, `acessLevel`) VALUES
('rajeev', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'rajeevs1992@gmail.com', 3);
