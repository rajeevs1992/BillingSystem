-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 18, 2012 at 11:02 AM
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
  `total` float DEFAULT NULL,
  `billNo` varchar(10) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`slNo`, `mrp`, `PplusT`, `name`, `code`, `qty`, `unitPrice`, `rateOfTax`, `taxAmt`, `total`, `billNo`, `user`) VALUES
(1, 60, 57.318, 'Lavender', 'vin', 5, 50.5, 13.5, 34.09, 286.59, '1', 'rajeev'),
(2, 10, 10.215, 'Pen', 'abc', 8, 9, 13.5, 9.72, 81.72, '1', 'rajeev'),
(3, 50, 42.42, 'Arrows', 'b008', 1, 40.4, 5, 2.02, 42.42, '1', 'rajeev'),
(1, 10, 10.215, 'Pen', 'abc', 1, 9, 13.5, 1.22, 10.22, '2', 'rajeev'),
(2, 60, 57.318, 'Lavender', 'vin', 1, 50.5, 13.5, 6.82, 57.32, '2', 'rajeev'),
(3, 50, 42.42, 'Arrows', 'b008', 1, 40.4, 5, 2.02, 42.42, '2', 'rajeev'),
(1, 10, 10.215, 'Pen', 'abc', 1, 9, 13.5, 1.22, 10.22, '3', 'rajeev'),
(2, 60, 57.318, 'Lavender', 'vin', 1, 50.5, 13.5, 6.82, 57.32, '3', 'rajeev'),
(3, 50, 42.42, 'Arrows', 'b008', 1, 40.4, 5, 2.02, 42.42, '3', 'rajeev'),
(1, 30, 29, 'Pen', 'pen', 1, 29, 0, 0, 29, '4', 'rajeev'),
(2, 60, 57.318, 'Lavender', 'vin', 1, 50.5, 13.5, 6.82, 57.32, '4', 'rajeev'),
(3, 50, 42.42, 'Arrows', 'b008', 1, 40.4, 5, 2.02, 42.42, '4', 'rajeev');

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
  `purchasingPrice` float DEFAULT NULL,
  `profit` float DEFAULT NULL,
  `profitMode` int(1) NOT NULL,
  `totalStock` int(11) DEFAULT NULL,
  `openingStock` int(11) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`code`, `name`, `mrp`, `unitPrice`, `rateOfTax`, `purchasingPrice`, `profit`, `profitMode`, `totalStock`, `openingStock`) VALUES
('abc', 'Pen', 10, 7.07, 1, 7, 1, 0, 154, 150),
('vin', 'Lavender', 60, 50.5, 2, 50, 1, 0, 9, 17),
('b008', 'Arrows', 50, 40.4, 1, 40, 1, 0, 46, 50);

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
('1', '2012-06-16', 0, 0, 324.5, 0, 43.81, 324.5, 'CA'),
('3', '2012-06-16', 0, 40.4, 59.5, 2.02, 8.04, 99.9, 'CA'),
('4', '2012-06-16', 29, 40.4, 50.5, 2.02, 6.82, 119.9, 'CA');

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
