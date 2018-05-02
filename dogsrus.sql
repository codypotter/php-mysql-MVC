-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2018 at 08:17 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dogsrus`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerName` tinytext NOT NULL COMMENT 'Name of customer',
  `customerSinceDate` date NOT NULL COMMENT 'Customer since date',
  `customerID` int(11) NOT NULL COMMENT 'Customer ID',
  `dollarsSpent` float NOT NULL COMMENT 'Dollars spent',
  `lastVisitDate` date NOT NULL COMMENT 'Last visit date'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='List of customers';

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerName`, `customerSinceDate`, `customerID`, `dollarsSpent`, `lastVisitDate`) VALUES
('Ricky Beevis', '2018-05-01', 1, 0, '2018-05-01'),
('Jimmy Pants', '0000-00-00', 2, 12, '0000-00-00'),
('Jenny Slate', '2018-05-02', 3, 0, '2018-05-02'),
('Jared Burgers', '2018-05-02', 4, 0, '2018-05-02');

-- --------------------------------------------------------

--
-- Table structure for table `dogs`
--

CREATE TABLE `dogs` (
  `dogName` tinytext NOT NULL COMMENT 'Dog name',
  `dogID` int(11) NOT NULL COMMENT 'Dog ID',
  `customerID` int(11) NOT NULL COMMENT 'Owner ID',
  `preferredGroomerID` int(11) NOT NULL COMMENT 'Preferred groomer ID',
  `temperament` int(11) NOT NULL COMMENT 'Temperament of dog-0 is lowest, 10 is highest',
  `dogBreed` tinytext NOT NULL COMMENT 'Dog breed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dogs`
--

INSERT INTO `dogs` (`dogName`, `dogID`, `customerID`, `preferredGroomerID`, `temperament`, `dogBreed`) VALUES
('Spot', 1, 1, 2, 4, 'dalmation'),
('Rex', 2, 1, 1, 10, 'golden retriever'),
('Henry', 4, 1, 1, 10, 'corgi');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employeeName` tinytext NOT NULL COMMENT 'full name of employee',
  `isGroomer` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'is a groomer',
  `employeeID` smallint(6) NOT NULL COMMENT 'unique employee ID',
  `wage` float NOT NULL DEFAULT '12.5' COMMENT 'wage ',
  `hireDate` date NOT NULL COMMENT 'hire date',
  `terminationDate` date DEFAULT NULL COMMENT 'termination date',
  `position` tinytext NOT NULL COMMENT 'name of position'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='A list of employees';

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employeeName`, `isGroomer`, `employeeID`, `wage`, `hireDate`, `terminationDate`, `position`) VALUES
('Cody Potter', 1, 1, 18, '2017-10-11', NULL, 'CEO'),
('Sally Field', 1, 2, 12.5, '2018-05-01', NULL, 'Groomer'),
('James Pants', 1, 3, 12.5, '2018-04-02', '2018-05-01', 'Groomer'),
('Sasha Pan', 0, 4, 14, '2018-04-10', NULL, 'Supervisor'),
('Rachel Barrietos', 0, 5, 12.5, '2018-05-02', NULL, 'Groomer'),
('Tommy Overalls', 1, 6, 14, '2018-05-02', NULL, 'Supervisor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `dogs`
--
ALTER TABLE `dogs`
  ADD PRIMARY KEY (`dogID`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employeeID`),
  ADD UNIQUE KEY `employeeID` (`employeeID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Customer ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dogs`
--
ALTER TABLE `dogs`
  MODIFY `dogID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Dog ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employeeID` smallint(6) NOT NULL AUTO_INCREMENT COMMENT 'unique employee ID', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
