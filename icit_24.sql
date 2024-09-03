-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2024 at 08:05 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icit_24`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `ROLE` varchar(255) NOT NULL DEFAULT 'COORDINATOR',
  `OTP` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `NAME`, `EMAIL`, `PASSWORD`, `ROLE`, `OTP`, `created_at`) VALUES
(1, 'Arun', 'esecicit24@gmail.com', '$2y$12$U2kcv8JM23a/nDVy2yGLqulfia2bzODAjYIQjnE4GJSz9cKwUE276', 'ADMIN', 0, '2024-02-13 21:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `coordinators`
--

CREATE TABLE `coordinators` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `DESIGNATION` text NOT NULL,
  `ROLE` varchar(255) DEFAULT NULL,
  `COMMITTEE` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinators`
--

INSERT INTO `coordinators` (`ID`, `NAME`, `DESIGNATION`, `ROLE`, `COMMITTEE`, `created_at`) VALUES
(1, 'Thiru. G. Kamalamurugan', 'Correspondent, ESEC', 'Chief Patron', 'ORGANIZING', '2024-02-26 19:22:01'),
(2, 'Thiru. V. Annadurai', 'President, ESET', 'Chief Patron', 'ORGANIZING', '2024-02-26 19:25:20'),
(3, 'Thiru. S. N. Thangaraju', 'Secretary, ESET', 'Patron', 'ORGANIZING', '2024-02-26 19:25:48'),
(4, 'Dr. V. Venkatachalam', 'Principal, ESEC', 'Chairman', 'ORGANIZING', '2024-02-26 19:26:22'),
(5, 'Dr. G. Sivakumar', 'Prof. & Head, Dept. of CSE', 'Conveners', 'ORGANIZING', '2024-02-26 19:27:19'),
(6, 'Dr. M. P. Thiruvenkatasuresh', 'Prof. & Head, Dept. of IT', 'Conveners', 'ORGANIZING', '2024-02-26 19:29:02'),
(7, 'Dr. M. Thangavel', 'Prof. & Head, Dept. of M.Tech. CSE', 'Conveners', 'ORGANIZING', '2024-02-26 19:30:01'),
(8, 'Dr. G. Saravanan', 'Prof. & Head, Dept. of AI&DS', 'Conveners', 'ORGANIZING', '2024-02-26 19:30:37'),
(9, 'Dr. S. Tamilselvan', 'Asso. Prof. & Head, Dept. of CSD', 'Conveners', 'ORGANIZING', '2024-02-26 19:31:06'),
(10, 'Prof. Ms. T. Kalaiselvi', 'Asso. Prof. / CSE', 'Organizing Committee', 'ORGANIZING', '2024-02-26 19:32:00'),
(11, 'Prof. Mr. K. A. Dhamotharan', 'Asso. Prof. / CSE', 'Organizing Committee', 'ORGANIZING', '2024-02-26 19:32:28'),
(12, 'Dr. Umarani', 'Asso. Prof. / IT', 'Organizing Committee', 'ORGANIZING', '2024-02-26 19:33:22'),
(13, 'Prof. Mr. G. Arun', 'Asst. Prof. / AI&DS', 'Organizing Committee', 'ORGANIZING', '2024-02-26 19:34:14'),
(14, 'Prof. Ms. D. Sivaselvi', 'Asst. Prof. / CSD', 'Organizing Committee', 'ORGANIZING', '2024-02-26 19:34:46'),
(15, 'Dr . Gheorghita Ghinea', 'Dept. of Computer Science, Brunel University London', '', 'ADVISORY', '2024-02-26 19:35:25'),
(16, 'Dr. Basim Al-Hadid', 'Al-Balqa Applied University, Jordan', '', 'ADVISORY', '2024-02-26 19:35:49'),
(17, 'Dr. Mohamed Uvaze Ahamed', 'New Uzbekistan University, Tashkent, Uzbekistan', '', 'ADVISORY', '2024-02-26 19:36:48'),
(18, 'Dr. Ahmed Salahaddin Shikhmuhamad', 'New Uzbekistan University, Tashkent, Uzbekistan', '', 'ADVISORY', '2024-02-26 19:37:08'),
(19, 'Dr. Natesan Srinivasan', 'IIT, Guwahati', '', 'ADVISORY', '2024-02-26 19:37:29'),
(20, 'Dr. Senthilmurugan', 'IIT, Guwahati', '', 'ADVISORY', '2024-02-26 19:37:51'),
(21, 'Dr. Pankaj Srivastava', 'MNIT, Allahabad', '', 'ADVISORY', '2024-02-26 19:38:14'),
(22, 'Dr. G. Mahadevan', 'Gandigram Rural Institute', '', 'ADVISORY', '2024-02-26 19:38:41'),
(23, 'Dr. J. Arulvalan', 'NIT, Nagaland', '', 'ADVISORY', '2024-02-26 19:39:09'),
(24, 'Dr. Murugesan', 'NIT, Trichirapalli', '', 'ADVISORY', '2024-02-26 19:39:29'),
(25, 'Dr. R. Rajeswari Sridhar', 'NIT, Trichy', '', 'ADVISORY', '2024-02-26 19:39:52'),
(26, 'Dr. K. R. Jothi', 'VIT, Vellore', '', 'ADVISORY', '2024-02-26 19:40:14'),
(27, 'Dr. M. Senthilkumar', 'Amritha University, Coimbatore', '', 'ADVISORY', '2024-02-26 19:40:35'),
(28, 'Dr. P. Prakash', 'VIT, Chennai', '', 'ADVISORY', '2024-02-26 19:40:56'),
(29, 'Dr. R. Venkatesan', 'Sastra University, Tanjore', '', 'ADVISORY', '2024-02-26 19:44:10'),
(30, 'Dr. S. Thirunavukarasu', 'Vels University, Chennai', '', 'ADVISORY', '2024-02-26 19:44:33'),
(31, 'Dr. T. Purusothaman', 'GCT, Coimbatore', '', 'ADVISORY', '2024-02-26 19:44:59'),
(32, 'Dr. V. Gopalakrishnan', 'GCT, Coimbatore', '', 'ADVISORY', '2024-02-26 19:45:26'),
(33, 'Dr. A.M. Kalpana', 'GCE, Salem', '', 'ADVISORY', '2024-02-26 19:45:57'),
(34, 'Dr. M. Marikkannan', 'GCE, Erode', '', 'ADVISORY', '2024-02-26 19:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

CREATE TABLE `papers` (
  `PAPER_ID` int(11) NOT NULL,
  `UID` varchar(255) NOT NULL,
  `PAPER_TITLE` text NOT NULL,
  `FILE_PATH` text NOT NULL,
  `STATUS` varchar(255) NOT NULL DEFAULT 'UPLOADED',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `paid_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UID` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PHONE` varchar(255) NOT NULL,
  `ADDRESS` text NOT NULL,
  `PID` int(11) NOT NULL,
  `ORGANISATION` text NOT NULL,
  `DESIGNATION` varchar(255) NOT NULL,
  `CATEGORY` varchar(255) NOT NULL,
  `OTP` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `papers`
--
ALTER TABLE `papers`
  ADD PRIMARY KEY (`PAPER_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `papers`
--
ALTER TABLE `papers`
  MODIFY `PAPER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
