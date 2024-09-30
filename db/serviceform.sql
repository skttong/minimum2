-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Sep 19, 2024 at 03:17 AM
-- Server version: 8.1.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_hrdmh`
--

-- --------------------------------------------------------

--
-- Table structure for table `serviceform`
--

CREATE TABLE `serviceform` (
  `mhpsID` int NOT NULL,
  `qustype` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `HospitalID` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `qus1_1` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus1_2` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus1_3` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus1_4` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus2_1` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus2_2` varchar(200) NOT NULL,
  `qus2_2_1` varchar(200) NOT NULL,
  `qus2_2_2` varchar(200) NOT NULL,
  `qus2_3` varchar(200) NOT NULL,
  `qus3_1` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus3_2` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus3_3` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus3_4` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus3_5` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `qus4_1` varchar(200) NOT NULL,
  `qus4_2` varchar(200) NOT NULL,
  `qus5_1` varchar(200) NOT NULL,
  `number_patients` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `problems_obstacles` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `feedback` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `DevelopmentPlan` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `statusfinal` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `UserID` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `mhpsDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `serviceform`
--

INSERT INTO `serviceform` (`mhpsID`, `qustype`, `HospitalID`, `qus1_1`, `qus1_2`, `qus1_3`, `qus1_4`, `qus2_1`, `qus2_2`, `qus2_2_1`, `qus2_2_2`, `qus2_3`, `qus3_1`, `qus3_2`, `qus3_3`, `qus3_4`, `qus3_5`, `qus4_1`, `qus4_2`, `qus5_1`, `number_patients`, `problems_obstacles`, `feedback`, `DevelopmentPlan`, `statusfinal`, `UserID`, `mhpsDate`) VALUES
(51, '3', '11463', '0,1,0', '', '', '', '0,0,0,1,0,0,0,0,0,0,0,0', '1,0', '1,0,0,0', '0,1,0,0', '0,0,0,0,1,0,0,0', '0,0,0', '', '0', '0', '0,0,0', '0,0,1,0', '0,0,1,0', '0,1,0', '0,0,0,0,0,0,0,0,0,0,0', '0', '0', '0', '0', '11154', '2024-09-17 07:47:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `serviceform`
--
ALTER TABLE `serviceform`
  ADD PRIMARY KEY (`mhpsID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `serviceform`
--
ALTER TABLE `serviceform`
  MODIFY `mhpsID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
