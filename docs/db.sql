-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 31, 2012 at 12:08 AM
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
  `billNo` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

REPLACE INTO `invoices` (`slNo`, `mrp`, `PplusT`, `name`, `code`, `qty`, `unitPrice`, `rateOfTax`, `taxAmt`, `cess`, `total`, `billNo`) VALUES
(1, 3, 3.12, 'Pencil Apsara', '001', 15, 3, 4, 1.8, 0.001, 46.8, '1'),
(2, 12, 13.5, 'eraser', 'abc', 15, 12, 12.5, 22.5, 0.015, 202.5, '1'),
(3, 5, 5, 'lexi', '101', 5, 5, 0, 0, 0, 25, '1');

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
('001', 'Pencil Apsara', 3, 3, 4, 2.75, 2.35, 0.25, 85, 104),
('abc', 'eraser', 12, 12, 12.5, 15, 12, 3, 0, 15),
('101', 'lexi', 5, 5, 0, 5, 5, 0, 45, 56);

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
  `user` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`billNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

REPLACE INTO `sales` (`billNo`, `date`, `salesNonTax`, `sales4pcTax`, `sales125pcTax`, `tax4pc`, `tax125pc`, `cess4pc`, `cess125pc`, `totalWithoutTax`, `cashOrCredit`, `user`) VALUES
('1', '2012-05-30', 25, 46.8, 202.5, 1.8, 22.5, 0.001, 0.015, 274.3, 'C', 'rajeev');

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
