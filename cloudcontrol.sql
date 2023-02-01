-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 05:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudcontrol`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_data_received`
--

CREATE TABLE `tbl_data_received` (
  `ID` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `LO_kWh` decimal(10,0) NOT NULL,
  `CO_LO_kWh` decimal(10,0) NOT NULL,
  `ACU_LO_kWh` decimal(10,0) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_device`
--

CREATE TABLE `tbl_device` (
  `device_id` int(11) NOT NULL,
  `device_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_scheds`
--

CREATE TABLE `tbl_scheds` (
  `ID` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `monday` time NOT NULL,
  `tuesday` time NOT NULL,
  `wednesday` time NOT NULL,
  `thursday` time NOT NULL,
  `friday` time NOT NULL,
  `saturday` time NOT NULL,
  `sunday` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_info`
--

CREATE TABLE `tbl_user_info` (
  `id_number` varchar(20) NOT NULL,
  `acc_type` varchar(20) NOT NULL,
  `rfid_code` text NOT NULL,
  `acc_status` varchar(20) NOT NULL,
  `p_consumable` decimal(10,0) NOT NULL,
  `p_consumed` decimal(10,0) NOT NULL,
  `acc_pw` text NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `family_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_info`
--

INSERT INTO `tbl_user_info` (`id_number`, `acc_type`, `rfid_code`, `acc_status`, `p_consumable`, `p_consumed`, `acc_pw`, `first_name`, `middle_name`, `family_name`) VALUES
('asdf', 'faculty', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', 'asdfa', 'afasdf', 'asdfa'),
('asdfasd', 'student', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', 'asdfasdf', 'asdfas', 'asdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_data_received`
--
ALTER TABLE `tbl_data_received`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_scheds`
--
ALTER TABLE `tbl_scheds`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_data_received`
--
ALTER TABLE `tbl_data_received`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_scheds`
--
ALTER TABLE `tbl_scheds`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
