-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 01:27 PM
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
-- Database: `attendance_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceId` int(11) NOT NULL,
  `Student_ID` varchar(30) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timeIn` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceId`, `Student_ID`, `status`, `date`, `timeIn`) VALUES
(19, '060917', 'Present', '2025-04-22', '11:00:35'),
(21, '830530', 'Absent', '2025-04-22', NULL),
(22, '060917', 'Present', '2025-04-25', '15:32:00'),
(24, '830530', 'Absent', '2025-04-25', NULL),
(25, '060203', 'Present', '2025-04-25', '15:30:23'),
(26, '060203', 'Present', '2025-04-27', '18:22:21'),
(27, '060917', 'Present', '2025-04-27', '18:58:11'),
(28, '830530', 'Absent', '2025-04-27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffName` varchar(150) NOT NULL,
  `staffId` varchar(30) NOT NULL,
  `staffPass` varchar(30) NOT NULL,
  `staffContact` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffName`, `staffId`, `staffPass`, `staffContact`) VALUES
('Ali bin Abu', '830607010179', '830607', 123987654);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentName` varchar(150) NOT NULL,
  `Student_ID` varchar(30) NOT NULL,
  `Contact` int(30) NOT NULL,
  `Program` varchar(100) NOT NULL,
  `Class` varchar(30) NOT NULL,
  `Picture` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentName`, `Student_ID`, `Contact`, `Program`, `Class`, `Picture`) VALUES
('Adam Asyraff', '060203', 14567984, 'FIS', 'S01', '060203.jpg'),
('Kimi', '060917', 1111417209, 'FET', 'E01', '060917.png'),
('Elon Musk', '830530', 1243534, 'FET', 'E13', '830530.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceId`),
  ADD KEY `Student_ID` (`Student_ID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Student_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `student` (`Student_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
