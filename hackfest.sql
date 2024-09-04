-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 12:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hackfest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `OTP` int(11) DEFAULT NULL,
  `ROLE` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `NAME`, `EMAIL`, `PASSWORD`, `OTP`, `ROLE`, `created_at`) VALUES
(1, 'HackFest', 'hackfest@esec.ac.in', '$2y$12$HUH4kehlEWIFRyUTGYb4IuOX7UAzsbNIX7aet4YPoIvSqO.UAdBP6', 0, 'ADMIN', '2024-09-03 21:16:49');

-- --------------------------------------------------------

--
-- Table structure for table `otp`
--

CREATE TABLE `otp` (
  `ID` int(11) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `OTP` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `otp`
--

INSERT INTO `otp` (`ID`, `EMAIL`, `OTP`, `created_at`) VALUES
(1, 'jp008882@gmail.com', 500690, '2024-09-03 14:55:40'),
(2, 'jp008882@gmail.com', 500690, '2024-09-03 14:57:32'),
(3, 'jp008882@gmail.com', 500690, '2024-09-03 14:58:52'),
(4, 'jp008882@gmail.com', 500690, '2024-09-03 14:59:13'),
(5, 'jp008882@gmail.com', 500690, '2024-09-03 15:01:24'),
(6, 'jp008882@gmail.com', 639977, '2024-09-03 15:10:05'),
(7, 'jp008882@gmail.com', 276391, '2024-09-03 15:11:03'),
(8, 'jp008882@gmail.com', 741548, '2024-09-03 21:52:10'),
(9, 'jp008882@gmail.com', 680575, '2024-09-03 21:54:04'),
(10, 'jp008882@gmail.com', 223461, '2024-09-03 21:58:28'),
(11, 'jp008882@gmail.com', 468054, '2024-09-03 21:59:44'),
(12, 'jp008882@gmail.com', 483365, '2024-09-03 22:02:50'),
(13, 'jp008882@gmail.com', 362722, '2024-09-03 22:03:52'),
(14, 'jp008882@gmail.com', 231829, '2024-09-03 22:06:37'),
(15, 'jp008882@gmail.com', 771999, '2024-09-03 22:07:27'),
(16, 'jp008882@gmail.com', 405180, '2024-09-03 22:30:31'),
(17, 'jp008882@gmail.com', 593385, '2024-09-03 22:33:00'),
(18, 'jp008882@gmail.com', 819463, '2024-09-03 22:34:21'),
(19, 'jp008882@gmail.com', 298940, '2024-09-03 22:40:12'),
(20, 'sivanandh10cc@gmail.com', 387385, '2024-09-04 14:23:18'),
(21, 'sivanandh10cc@gmail.com', 596016, '2024-09-04 14:23:31'),
(22, 'sivanandh10cc@gmail.com', 329354, '2024-09-04 14:24:19'),
(23, 'sivanandh10cc@gmail.com', 905815, '2024-09-04 14:24:39'),
(24, 'sivanandh10cc@gmail.com', 567786, '2024-09-04 14:25:02'),
(25, 'sivanandh10cc@gmail.com', 745644, '2024-09-04 14:25:25'),
(26, 'sivanandh10cc@gmail.com', 304170, '2024-09-04 14:44:54'),
(27, 'sivanandh10cc@gmail.com', 225364, '2024-09-04 14:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `ID` int(11) NOT NULL,
  `UID` varchar(255) NOT NULL,
  `TRANSACTION_ID` varchar(255) NOT NULL,
  `PAYMENT_DATE` date NOT NULL,
  `SCREENSHOT` varchar(255) NOT NULL,
  `STATUS` varchar(255) NOT NULL DEFAULT 'NOT VERIFIED',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `MOBILE` varchar(255) NOT NULL,
  `YEAR` varchar(255) NOT NULL,
  `DEPARTMENT` varchar(255) NOT NULL,
  `COLLEGE` text NOT NULL,
  `GENDER` varchar(255) NOT NULL,
  `T_ID` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`ID`, `NAME`, `EMAIL`, `MOBILE`, `YEAR`, `DEPARTMENT`, `COLLEGE`, `GENDER`, `T_ID`, `created_at`) VALUES
(1, 'Jayaprakash E K', 'jp008882@gmail.com', '9025019506', 'IV', 'CSE', 'ESEC', 'MALE', 'HF001', '2024-09-03 22:42:53'),
(3, 'KANNAN M', 'kannanmuruganandham1@gmail.com', '6382511495', 'IV', 'CSE', 'ESEC', 'MALE', 'HF001', '2024-09-03 22:42:53'),
(4, 'HARIHARAN K', 'haripsp2004@gmail.com', '9080083526', 'IV', 'CSE', 'ESEC', 'MALE', 'HF001', '2024-09-03 22:42:53'),
(5, 'siva', 'sivanandh10cc@gmail.com', '9342446559', 'III', 'CSE', 'Panimalar engineering college', 'MALE', 'HF002', '2024-09-04 14:45:24'),
(6, '', 'sivanandh10cc@gmail.com', '', '', '', 'Panimalar engineering college', '', 'HF002', '2024-09-04 14:45:24'),
(7, 'siva', 'sivanandh10cc@gmail.com', '9342446559', 'II', 'CSE', 'Panimalar engineering college', 'MALE', 'HF002', '2024-09-04 14:49:03'),
(8, '', 'sivanandh10cc@gmail.com', '', '', '', 'Panimalar engineering college', '', 'HF002', '2024-09-04 14:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `ID` int(11) NOT NULL,
  `T_ID` varchar(255) NOT NULL,
  `TITLE` text NOT NULL,
  `STATUS` varchar(255) NOT NULL DEFAULT 'UPLOADED',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`ID`, `T_ID`, `TITLE`, `STATUS`, `created_at`) VALUES
(1, 'HF001', 'Sample', 'ACCEPTED', '0000-00-00 00:00:00'),
(3, 'HF002', 'IOT', 'UNDER REVIEW', '2024-09-04 14:49:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `otp`
--
ALTER TABLE `otp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `otp`
--
ALTER TABLE `otp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
