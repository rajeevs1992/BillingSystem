-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2012 at 12:19 AM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.4

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

REPLACE INTO `invoices` (`slNo`, `mrp`, `PplusT`, `name`, `code`, `qty`, `unitPrice`, `rateOfTax`, `taxAmt`, `cess`, `total`, `billNo`, `user`) VALUES
(1, 3, 3.12, 'Pencil Apsara', '001', 15, 3, 4, 1.8, 0.001, 46.8, '1', NULL),
(2, 12, 13.5, 'eraser', 'abc', 15, 12, 12.5, 22.5, 0.015, 202.5, '1', NULL),
(3, 5, 5, 'lexi', '101', 5, 5, 0, 0, 0, 25, '1', NULL),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 1, 9.61, 4, 0.384, 0.004, 9.994, '2', NULL),
(2, 0, 4.995, 'Arrows', 'a003', 6, 4.44, 12.5, 3.33, 0.006, 29.97, '2', NULL),
(3, 0, 119.954, 'Box Sigma Instrument', 'b010', 1, 115.34, 4, 4.614, 0.046, 119.954, '2', NULL),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 15, 9.61, 4, 5.766, 0.004, 149.91, '3', NULL),
(2, 0, 4.995, 'Arrows', 'a003', 15, 4.44, 12.5, 8.325, 0.006, 74.925, '3', NULL),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 1, 9.61, 4, 0.384, 0.004, 9.994, '4', NULL),
(2, 0, 4.995, 'Arrows', 'a003', 1, 4.44, 12.5, 0.555, 0.006, 4.995, '4', NULL),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 100, 9.61, 4, 38.44, 0.004, 999.4, '5', NULL),
(1, 0, 9.994, 'Book-Theodolite field book', 'b008', 15, 9.61, 4, 5.766, 0.004, 149.91, '6', 'rajeev');

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

REPLACE INTO `item` (`code`, `name`, `mrp`, `unitPrice`, `rateOfTax`, `sellingPrice`, `purchasingPrice`, `profitPerUnit`, `totalStock`, `openingStock`) VALUES
('b008', 'Book-Theodolite field book', NULL, 9.61, 4, 10, 8, 10, 4, 287),
('a003', 'Arrows', NULL, 4.44, 12.5, 5, NULL, 5, 8, 15),
('b010', 'Box Sigma Instrument', NULL, 115.34, 4, 120, NULL, 120, 119, 149);

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

REPLACE INTO `purchase` (`code`, `qty`, `date`) VALUES
('b008', 15, '2012-06-18'),
('b008', 15, '2012-06-18'),
('b008', 15, '2012-06-18'),
('b008', 15, '2012-06-18'),
('b008', 15, '2012-06-18'),
('b008', 15, '2012-06-18'),
('a003', 15, '2012-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `billNo` varchar(10) NOT NULL,
  `date` date DEFAULT NULL,
  `salesNonTax` float DEFAULT NULL,
  `sales4pcTax` float DEFAULT NULL,
  `sales125pcTax` float DEFAULT NULL,
  `tax4pc` float DEFAULT NULL,
  `tax125pc` float DEFAULT NULL,
  `cess4pc` float DEFAULT NULL,
  `cess125pc` float DEFAULT NULL,
  `totalWithoutTax` float DEFAULT NULL,
  `cashOrCredit` char(1) DEFAULT NULL,
  PRIMARY KEY (`billNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

REPLACE INTO `sales` (`billNo`, `date`, `salesNonTax`, `sales4pcTax`, `sales125pcTax`, `tax4pc`, `tax125pc`, `cess4pc`, `cess125pc`, `totalWithoutTax`, `cashOrCredit`) VALUES
('1', '2012-05-30', 25, 46.8, 202.5, 1.8, 22.5, 0.001, 0.015, 274.3, 'C'),
('2', '2012-06-13', 0, 129.948, 29.97, 4.998, 3.33, 0.05, 0.006, 159.918, 'C'),
('3', '2012-06-18', 0, 149.91, 74.925, 5.766, 8.325, 0.004, 0.006, 224.835, 'C'),
('4', '2012-06-18', 0, 9.994, 4.995, 0.384, 0.555, 0.004, 0.006, 14.989, 'C'),
('5', '2012-06-18', 0, 0, 0, 0, 0, 0, 0, 0, 'C'),
('6', '2012-06-19', 0, 149.91, 0, 5.766, 0, 0.004, 0, 149.91, 'C');

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

REPLACE INTO `users` (`uname`, `passwd`, `email`, `acessLevel`) VALUES
('rajeev', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'rajeevs1992@gmail.com', 3);

create table temp (tempBillNo INT(11),code varchar(5),qty int(11));
