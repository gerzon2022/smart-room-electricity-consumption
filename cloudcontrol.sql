-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 01:25 AM
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
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `building` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `status` enum('available','unavailable','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`id`, `building`, `room_number`, `status`) VALUES
(14, 'testBuilding1', 'testRoom1', 'available'),
(16, 'testBuilding3', 'testRoom3', 'unavailable'),
(17, 'testBuilding4', 'testRoom4', 'unavailable'),
(19, 'IT BUILDING', '1', 'available'),
(20, 'IT BUILDING 1', '2', 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `building`, `room_number`, `start_time`, `end_time`) VALUES
(26, 'testBuilding2', 'testRoom2', '2023-02-01 08:30:00', '2023-02-01 10:30:00'),
(29, 'testBuilding4', 'testRoom4', '2023-01-17 15:54:00', '2023-01-17 17:54:00'),
(30, 'testBuilding2', 'testRoom2', '2023-01-03 15:55:00', '2023-01-03 17:56:00'),
(31, 'testBuilding1', 'testRoom1', '2023-01-08 04:06:00', '2023-01-08 05:06:00'),
(32, 'IT BUILDING', '1', '2023-02-10 15:24:00', '2023-02-10 15:24:00'),
(33, 'IT BUILDING', '1', '2023-02-09 15:24:00', '2023-02-09 15:24:00');

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
-- Table structure for table `tbl_rfid`
--

CREATE TABLE `tbl_rfid` (
  `id` int(11) NOT NULL,
  `rfid` varchar(255) NOT NULL
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
  `acc_status` varchar(20) NOT NULL DEFAULT 'inactive',
  `p_consumable` decimal(10,0) NOT NULL DEFAULT 300,
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
('2', 'admin', '', 'active', '0', '0', '202cb962ac59075b964b07152d234b70', 'Admin', 'Admin', 'Admin'),
('12312321', 'faculty', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', 'asdf', 'asdf', 'asdf'),
('12312312', 'faculty', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', '123123', '123', '112312'),
('123123', 'student', '', '', '123', '0', '202cb962ac59075b964b07152d234b70', 'fasdf', 'asdfa', 'sdfasdf'),
('3123123', 'student', '', 'inactive', '12', '0', '912ec803b2ce49e4a541068d495ab570', 'asdfa', 'sdfasd', 'asdf'),
('asdfsdffas', 'student', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', 'asdf', 'afa', 'sdfasdf'),
('12312', 'student', '', '', '0', '0', '202cb962ac59075b964b07152d234b70', '123', '12', 'afasdf'),
('123', 'faculty', '', 'inactive', '300', '0', '202cb962ac59075b964b07152d234b70', 'asdfa', 'asdf', 'asdf'),
('1233', 'faculty', '', 'inactive', '300', '0', 'e034fb6b66aacc1d48f445ddfb08da98', '12312', '123', '123123'),
('31231', 'student', '', 'inactive', '300', '0', '202cb962ac59075b964b07152d234b70', '123', '123', '2312'),
('12331', 'faculty', '', 'inactive', '300', '0', '202cb962ac59075b964b07152d234b70', 'test', 'test', 'test'),
('fasdf', 'faculty', '', 'inactive', '300', '0', '912ec803b2ce49e4a541068d495ab570', 'asdfas', 'dfasdf', 'sdfasd'),
('31213', 'student', '', 'inactive', '300', '0', '202cb962ac59075b964b07152d234b70', 'gera', 'aasdf', 'asdf'),
('student1', 'student', '', 'inactive', '300', '0', '202cb962ac59075b964b07152d234b70', 'John', 'Didi', 'Doe');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_data_received`
--
ALTER TABLE `tbl_data_received`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_rfid`
--
ALTER TABLE `tbl_rfid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_scheds`
--
ALTER TABLE `tbl_scheds`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_data_received`
--
ALTER TABLE `tbl_data_received`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_rfid`
--
ALTER TABLE `tbl_rfid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_scheds`
--
ALTER TABLE `tbl_scheds`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
