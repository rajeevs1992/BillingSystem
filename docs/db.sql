-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 23, 2012 at 12:34 AM
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
  `total` float DEFAULT NULL,
  `billNo` varchar(10) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`slNo`, `mrp`, `PplusT`, `name`, `code`, `qty`, `unitPrice`, `rateOfTax`, `taxAmt`, `total`, `billNo`, `user`) VALUES
(1, 10, 7.424, 'Pen', 'abc', 6, 7.07, 5, 2.12, 44.54, '1', 'rajeev'),
(2, 60, 57.885, 'Lavender', 'vin', 1, 51, 13.5, 6.89, 57.89, '1', 'rajeev'),
(3, 100, 75, 'Keyboard', 'qwe', 1, 75, 0, 0, 75, '1', 'rajeev'),
(1, 60, 57.885, 'Lavender', 'vin', 8, 51, 13.5, 55.08, 463.08, '2', 'rajeev'),
(2, 10, 7.424, 'Pen', 'abc', 6, 7.07, 5, 2.12, 44.54, '2', 'rajeev'),
(1, 100, 75, 'Keyboard', 'qwe', 8, 75, 0, 0, 600, '3', 'rajeev');

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
('abc', 'Pen', 10, 7.07, 1, 7, 1, 0, 137, 149),
('vin', 'Lavender', 60, 51, 2, 50, 1, 1, 110, 119),
('b008', 'Arrows', 50, 40.4, 1, 40, 1, 0, 35, 35),
('qwe', 'Keyboard', 100, 75, 0, 70, 5, 1, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `inv_no` varchar(15) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rot` int(11) NOT NULL,
  `pp` float NOT NULL,
  `taxAmt` float NOT NULL,
  `from` varchar(100) NOT NULL,
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
('1', '2012-07-23', 75, 42.42, 51, 2.12, 6.89, 168.42, 'CA'),
('2', '2012-07-23', 0, 42.42, 408, 2.12, 55.08, 450.42, 'CA'),
('3', '2012-07-23', 600, 0, 0, 0, 0, 600, 'CA');

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
('rajeev', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'rajeevs1992@gmail.com', 3),
('user1', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'rajeevs1992@gmail.com', 3);
