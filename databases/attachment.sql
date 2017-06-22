-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 21, 2017 at 11:34 PM
-- Server version: 5.7.15
-- PHP Version: 7.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attachment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_applicants`
--

CREATE TABLE `tbl_applicants` (
  `id` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `userEmail` varchar(100) DEFAULT NULL,
  `userPhone` int(12) DEFAULT NULL,
  `about` varchar(300) DEFAULT NULL,
  `postId` int(11) NOT NULL,
  `postTime` varchar(200) DEFAULT NULL,
  `sent` varchar(100) NOT NULL DEFAULT 'NO',
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_posts`
--

CREATE TABLE `tbl_posts` (
  `id` int(11) NOT NULL,
  `companyName` varchar(100) NOT NULL,
  `companyEmail` varchar(100) NOT NULL,
  `companyPhone` int(12) DEFAULT NULL,
  `position` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `detail` varchar(300) DEFAULT NULL,
  `location` varchar(100) NOT NULL DEFAULT 'General',
  `numb` int(12) DEFAULT NULL,
  `postTime` varchar(100) DEFAULT NULL,
  `startDate` varchar(100) NOT NULL,
  `duration` int(100) NOT NULL,
  `deadlineDay` int(100) NOT NULL,
  `deadlineMonth` int(100) NOT NULL,
  `deadlineYear` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `companyName`, `companyEmail`, `companyPhone`, `position`, `level`, `category`, `detail`, `location`, `numb`, `postTime`, `startDate`, `duration`, `deadlineDay`, `deadlineMonth`, `deadlineYear`) VALUES
(22, 'CAK', 'beja.emmanuel@gmail.com', 712991415, 'PHP Developer', 'Attachment', 'Computing', 'I need young hardworking students for an internship', 'Nairobi', 2, NULL, '25-Jun-2017', 3, 20, 6, 2017),
(24, 'CAK', 'beja.emmanuel@gmail.com', 712991415, 'Java Developer', 'Attachment', 'Computing', 'I need young hardworking students for an internship', 'Nairobi', 3, NULL, '26-Jun-2017', 3, 21, 6, 2017);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prof`
--

CREATE TABLE `tbl_prof` (
  `id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `userName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userPhone` int(12) DEFAULT NULL,
  `loginType` varchar(100) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPass`, `userPhone`, `loginType`) VALUES
(1, 'beja', 'beja.emmanuel@yahoo.com', '202cb962ac59075b964b07152d234b70', 712121212, 'admin'),
(16, 'Oghma Technologies', 'gitau.h.mwangi@gmail.com', '202cb962ac59075b964b07152d234b70', 701247794, 'company'),
(17, 'CAK', 'beja.emmanuel@gmail.com', '202cb962ac59075b964b07152d234b70', 712991415, 'company'),
(18, 'Coretec Solutions', 'felokemboi10@gmail.com', '202cb962ac59075b964b07152d234b70', 722116291, 'company'),
(20, 'KPA', 'stellawinnie12@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 712121212, 'company'),
(21, 'TM Networks', 'emmcodes@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 712121212, 'company'),
(22, 'KK Security', 'kk@gmail.com', '25d55ad283aa400af464c76d713c07ad', 712121212, 'company'),
(23, 'kebs', 'kebs@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 712121212, 'company'),
(24, 'Kenya Airways', 'kq@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 712121212, 'company');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_applicants`
--
ALTER TABLE `tbl_applicants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `companyName` (`companyName`),
  ADD KEY `userName` (`userName`),
  ADD KEY `postId` (`postId`);

--
-- Indexes for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `companyName` (`companyName`),
  ADD KEY `companyEmail` (`companyEmail`);

--
-- Indexes for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `userName` (`userName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`),
  ADD KEY `userName` (`userName`),
  ADD KEY `userID` (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_applicants`
--
ALTER TABLE `tbl_applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_applicants`
--
ALTER TABLE `tbl_applicants`
  ADD CONSTRAINT `foreignkeycompanyusers` FOREIGN KEY (`companyName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foreignkeypostid` FOREIGN KEY (`postId`) REFERENCES `tbl_posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  ADD CONSTRAINT `foreignkeypostcompany` FOREIGN KEY (`companyName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  ADD CONSTRAINT `foreignkeyImageuser` FOREIGN KEY (`userName`) REFERENCES `users` (`userName`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
