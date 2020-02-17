-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2011 at 09:27 PM
-- Server version: 5.5.10
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `spsd_network_equipment`
--

-- --------------------------------------------------------

--
-- Table structure for table `closetdevices`
--

CREATE TABLE IF NOT EXISTS `closetdevices` (
  `Name` varchar(100) NOT NULL COMMENT 'Required',
  `ParentName` varchar(100) DEFAULT NULL COMMENT 'Required',
  `School` varchar(100) NOT NULL COMMENT 'Required',
  `Closet` varchar(100) NOT NULL COMMENT 'Required',
  `Equipment` varchar(250) NOT NULL COMMENT 'Required',
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Required',
  `NodeID` text NOT NULL,
  `Serial` text NOT NULL,
  `MAC` varchar(12) NOT NULL,
  `NumPorts` int(11) NOT NULL,
  `NumPoEPorts` int(11) NOT NULL,
  `NumFreePorts` int(11) NOT NULL,
  `NumFreePoEPorts` int(11) NOT NULL,
  `IP` text NOT NULL,
  `Note` text NOT NULL,
  UNIQUE KEY `Name` (`Name`),
  KEY `School` (`School`),
  KEY `Closet` (`Closet`),
  KEY `Equipment` (`Equipment`),
  KEY `ParentName` (`ParentName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closetdevices`
--


-- --------------------------------------------------------

--
-- Table structure for table `closetequipment`
--

CREATE TABLE IF NOT EXISTS `closetequipment` (
  `Name` varchar(250) NOT NULL,
  `Manufacturer` varchar(250) NOT NULL,
  `EquipmentName` varchar(250) NOT NULL,
  `Description` varchar(250) NOT NULL,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closetequipment`
--


-- --------------------------------------------------------

--
-- Table structure for table `closets`
--

CREATE TABLE IF NOT EXISTS `closets` (
  `SchoolName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` text NOT NULL,
  UNIQUE KEY `key` (`SchoolName`,`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `closets`
--


-- --------------------------------------------------------

--
-- Table structure for table `displayedcdfields`
--

CREATE TABLE IF NOT EXISTS `displayedcdfields` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DisplayOrder` int(11) NOT NULL,
  `GenSortPriority` int(11) NOT NULL,
  `FieldName` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `displayedcdfields`
--

INSERT INTO `displayedcdfields` (`ID`, `DisplayOrder`, `GenSortPriority`, `FieldName`) VALUES
(6, 6, 6, 'NodeID'),
(7, 7, 7, 'Serial'),
(8, 8, 8, 'MAC'),
(9, 8, 8, 'NumPorts'),
(10, 9, 9, 'NumPoEPorts'),
(11, 10, 10, 'NumFreePorts'),
(12, 10, 10, 'NumFreePoEPorts'),
(13, 11, 11, 'IP'),
(14, 12, 12, 'Note');

-- --------------------------------------------------------

--
-- Table structure for table `displayedepdfields`
--

CREATE TABLE IF NOT EXISTS `displayedepdfields` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DisplayOrder` int(11) NOT NULL,
  `GenSortPriority` int(11) NOT NULL,
  `FieldName` text NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `displayedepdfields`
--

INSERT INTO `displayedepdfields` (`ID`, `DisplayOrder`, `GenSortPriority`, `FieldName`) VALUES
(2, 2, 2, 'NodeID'),
(12, 12, 12, 'Location'),
(14, 14, 14, 'PoE'),
(16, 16, 16, 'Note');

-- --------------------------------------------------------

--
-- Table structure for table `endpointdevices`
--

CREATE TABLE IF NOT EXISTS `endpointdevices` (
  `Name` varchar(100) NOT NULL COMMENT 'Required',
  `ParentName` varchar(100) DEFAULT NULL COMMENT 'Required',
  `School` varchar(100) NOT NULL COMMENT 'Required',
  `Floor` varchar(100) NOT NULL COMMENT 'Required',
  `Room` varchar(100) NOT NULL COMMENT 'Required',
  `Equipment` varchar(250) NOT NULL COMMENT 'Required',
  `Modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Required',
  `Closet` int(2) NOT NULL COMMENT 'Required',
  `Panel` int(2) NOT NULL COMMENT 'Required',
  `Port` int(3) NOT NULL COMMENT 'Required',
  `NodeID` varchar(100) NOT NULL,
  `Location` text NOT NULL,
  `PoE` int(1) NOT NULL,
  `Note` text NOT NULL,
  UNIQUE KEY `Name` (`Name`),
  KEY `Equipment` (`Equipment`),
  KEY `ParentName` (`ParentName`),
  KEY `School` (`School`),
  KEY `Floor` (`Floor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `endpointdevices`
--


-- --------------------------------------------------------

--
-- Table structure for table `endpointequipment`
--

CREATE TABLE IF NOT EXISTS `endpointequipment` (
  `Name` varchar(250) NOT NULL,
  `Manufacturer` varchar(250) NOT NULL,
  `EquipmentName` varchar(250) NOT NULL,
  `Description` varchar(250) NOT NULL,
  UNIQUE KEY `Name` (`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `endpointequipment`
--


-- --------------------------------------------------------

--
-- Table structure for table `floors`
--

CREATE TABLE IF NOT EXISTS `floors` (
  `SchoolName` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  UNIQUE KEY `key` (`SchoolName`,`Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `floors`
--


-- --------------------------------------------------------

--
-- Table structure for table `schools`
--

CREATE TABLE IF NOT EXISTS `schools` (
  `SchoolID` varchar(100) NOT NULL,
  `SchoolName` varchar(100) NOT NULL,
  UNIQUE KEY `SchoolName` (`SchoolName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schools`
--


--
-- Constraints for dumped tables
--

--
-- Constraints for table `closetdevices`
--
ALTER TABLE `closetdevices`
  ADD CONSTRAINT `closetdevices_ibfk_4` FOREIGN KEY (`Equipment`) REFERENCES `closetequipment` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `closetdevices_ibfk_2` FOREIGN KEY (`ParentName`) REFERENCES `closetdevices` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `closetdevices_ibfk_3` FOREIGN KEY (`School`) REFERENCES `schools` (`SchoolName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `closets`
--
ALTER TABLE `closets`
  ADD CONSTRAINT `closets_ibfk_1` FOREIGN KEY (`SchoolName`) REFERENCES `schools` (`SchoolName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `endpointdevices`
--
ALTER TABLE `endpointdevices`
  ADD CONSTRAINT `endpointdevices_ibfk_5` FOREIGN KEY (`Equipment`) REFERENCES `endpointequipment` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `endpointdevices_ibfk_3` FOREIGN KEY (`ParentName`) REFERENCES `closetdevices` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `endpointdevices_ibfk_4` FOREIGN KEY (`School`) REFERENCES `schools` (`SchoolName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `floors`
--
ALTER TABLE `floors`
  ADD CONSTRAINT `floors_ibfk_1` FOREIGN KEY (`SchoolName`) REFERENCES `schools` (`SchoolName`) ON DELETE CASCADE ON UPDATE CASCADE;
