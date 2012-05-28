-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 28, 2012 at 10:39 PM
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
  `billNo` int(11) NOT NULL,
  `itemCode` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`billNo`, `itemCode`, `qty`, `amount`, `date`) VALUES
(10000, '000', 0, 0, '1993-01-01');

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
('001', 'Pencil Apsara', 3, 3.56985, 12.5, 2.75, 2.5, 0.25, 100, 150),
('002', 'Eraser', 3, 3, 12.5, 2.75, 2.35, 0.4, 96, 104),
('abc', 'Rough Record', 15, 12, 12.5, 12, 11.9, 0.1, 50, 56);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `billNo` int(11) NOT NULL,
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
