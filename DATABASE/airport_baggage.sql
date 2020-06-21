-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 27, 2020 at 12:03 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `airport_baggage`
--

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `airportId` int(11) NOT NULL,
  `airportName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`airportId`, `airportName`) VALUES
(0, 'airport_0'),
(1, 'airport_1');

-- --------------------------------------------------------

--
-- Table structure for table `exitrfids`
--

CREATE TABLE `exitrfids` (
  `rfid` int(11) NOT NULL,
  `collectionCarouselId` int(11) NOT NULL,
  `airportId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exitrfids`
--

INSERT INTO `exitrfids` (`rfid`, `collectionCarouselId`, `airportId`, `userId`) VALUES
(0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rfids`
--

CREATE TABLE `rfids` (
  `rfid` varchar(10) NOT NULL,
  `airportId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `bagId` int(11) NOT NULL,
  `verdict` varchar(15) NOT NULL,
  `reason` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rfids`
--

INSERT INTO `rfids` (`rfid`, `airportId`, `userId`, `bagId`, `verdict`, `reason`) VALUES
('tag_8Mk71', 1, 0, 0, 'Passed', 'Yet to be scrutinized'),
('tag_BKRsq', 1, 0, 2, 'Passed', 'Yet to be scrutinized'),
('tag_n7td0', 1, 0, 1, 'Passed', 'Yet to be scrutinized');

-- --------------------------------------------------------

--
-- Table structure for table `stolenrfids`
--

CREATE TABLE `stolenrfids` (
  `rfid` varchar(10) NOT NULL,
  `bagId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `airportId` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `userType` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`id`, `userId`, `airportId`, `username`, `password`, `userType`) VALUES
(1, 0, 0, 'a', 'a', 'customer'),
(2, 2, 0, 'b', 'b', 'management'),
(3, 1, 0, 'c', 'c', 'customer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`airportId`);

--
-- Indexes for table `exitrfids`
--
ALTER TABLE `exitrfids`
  ADD PRIMARY KEY (`rfid`);

--
-- Indexes for table `rfids`
--
ALTER TABLE `rfids`
  ADD PRIMARY KEY (`rfid`);

--
-- Indexes for table `stolenrfids`
--
ALTER TABLE `stolenrfids`
  ADD PRIMARY KEY (`rfid`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
