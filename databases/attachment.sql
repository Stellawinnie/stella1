-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2017 at 12:33 PM
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
  `sent` varchar(100) NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_applicants`
--

INSERT INTO `tbl_applicants` (`id`, `companyName`, `userName`, `userEmail`, `userPhone`, `about`, `postId`, `postTime`, `sent`) VALUES
(14, 'CAK', 'Erick', 'erick@gmail.com', 712121212, 'kujaribu tu', 12, '9:43:08', 'No'),
(16, 'CAK', 'Erick', 'erick@gmail.com', 712121212, 'hello', 10, '13:39:44', 'No'),
(17, 'Coretec Solutions', 'Kathryn', 'kathiekim95@gmail.com', 754321456, 'hey', 9, '15:28:57', 'Yes'),
(20, 'CAK', 'Kathryn', 'kathiekim95@gmail.com', 754321456, 'dfgbhnm', 10, '13:25:13', 'Yes'),
(28, 'CAK', 'Kathryn', 'kathiekim95@gmail.com', 754321456, 'dffdd', 12, '15:15:02', 'Yes'),
(41, 'CAK', 'Emmanuel', 'beja.emmanuel@yahoo.com', 712991415, 'abc', 10, '21:03:48', 'No'),
(45, 'CAK', 'beja', 'beja.emmanuel@yahoo.com', 712991415, 'asdfv', 10, 'Mon May 29 2017 23:41:05 GMT+0300 (EAT)', 'No'),
(46, 'CAK', 'ra', 'beja.emmanuel@yahoo.com', 712991415, 'sdfgh', 10, 'Mon May 29 2017 23:42:09 GMT+0300 (EAT)', 'No'),
(47, 'CAK', 'ertyu', 'rtyuikl', 34567, 'dfghjkl', 12, 'Mon Jun 05 2017 13:47:57 GMT+0300 (EAT)', 'Yes');

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
  `numb` int(12) DEFAULT NULL,
  `postTime` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_posts`
--

INSERT INTO `tbl_posts` (`id`, `companyName`, `companyEmail`, `companyPhone`, `position`, `level`, `category`, `detail`, `numb`, `postTime`) VALUES
(9, 'Coretec Solutions', 'felokemboi10@gmail.com', 722116291, 'PHP Developer', 'Job', 'Computing', 'Looking for  backend developers with 2 years experience in php, laravel and ionic framework', 3, '0:51:43'),
(10, 'CAK', 'beja.emmanuel@gmail.com', 712991415, 'IT support', 'Job', 'Computing', 'programmers needed', 5, '0:51:25'),
(11, 'Coretec Solutions', 'felokemboi10@gmail.com', 722116291, 'Sales Director', 'Attachment', 'Bussiness', 'need sales people with experience as an added advantage', 5, '18:38:00'),
(12, 'CAK', 'beja.emmanuel@gmail.com', 712991415, 'MEAN developer', 'Job', 'Computing', 'I need young hardworking students for an internship', 4, '0:50:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prof`
--

CREATE TABLE `tbl_prof` (
  `id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `userName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_prof`
--

INSERT INTO `tbl_prof` (`id`, `image`, `userName`) VALUES
(1, 'Curly-Hairstyles-For-Black-Men.jpg', 'Erick'),
(2, 'Image.png', 'Kathryn');

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
  `loginType` varchar(100) DEFAULT 'user',
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userName`, `userEmail`, `userPass`, `userPhone`, `loginType`, `userStatus`, `tokenCode`) VALUES
(1, 'beja', 'beja.emmanuel@yahoo.com', '202cb962ac59075b964b07152d234b70', 712121212, 'admin', 'Y', '365f7971f66f9795f2d83733fb5b5c4e'),
(10, 'Erick', 'erick@gmail.com', '202cb962ac59075b964b07152d234b70', 712121212, 'company', 'Y', 'fc992b2e5879c5b90906b4dc4feb1ba3'),
(15, 'Kathryn', 'kathiekim95@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 754321456, 'company', 'Y', '4afacd16d7ccb34049c699f4c60269cf'),
(16, 'Oghma Technologies', 'gitau.h.mwangi@gmail.com', '202cb962ac59075b964b07152d234b70', 701247794, 'company', 'Y', '9487dd70d39df0f7f432b22454ba6f25'),
(17, 'CAK', 'beja.emmanuel@gmail.com', '202cb962ac59075b964b07152d234b70', 712991415, 'company', 'Y', '565991da4b857d281b1d73766e91c1f6'),
(18, 'Coretec Solutions', 'felokemboi10@gmail.com', '202cb962ac59075b964b07152d234b70', 722116291, 'company', 'Y', '9066728a477fdbcd90d42120707d924e');

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
  ADD KEY `companyName` (`companyName`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `tbl_posts`
--
ALTER TABLE `tbl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbl_prof`
--
ALTER TABLE `tbl_prof`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
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
