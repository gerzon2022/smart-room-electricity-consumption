-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 09:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerzon`
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
(15, 'testBuilding2', 'testRoom2', 'available'),
(16, 'testBuilding3', 'testRoom3', 'available'),
(17, 'testBuilding4', 'testRoom4', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `building` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `user`, `course`, `building`, `room_number`, `start_time`, `end_time`) VALUES
(22, 'Test Student1', 'testCourse', 'testBuilding1', 'testRoom1', '2023-01-11 16:00:00', '2023-01-11 17:00:00'),
(23, 'Test Student2', 'testCourse', 'testBuilding2', 'testRoom2', '2023-01-12 17:30:00', '2023-01-12 21:00:00'),
(24, 'Test Student3', 'testCourse', 'testBuilding3', 'testRoom3', '2023-01-13 13:30:00', '2023-01-13 16:00:00'),
(26, 'Test Student2', 'testCourse', 'testBuilding2', 'testRoom2', '2023-02-01 08:30:00', '2023-02-01 10:30:00'),
(28, 'Test Student1', 'testCourse', 'testBuilding1', 'testRoom1', '2023-01-10 18:41:00', '2023-01-10 20:41:00'),
(29, 'Test Student2', 'testCourse', 'testBuilding4', 'testRoom4', '2023-01-17 15:54:00', '2023-01-17 17:54:00'),
(30, 'Test Student2', 'testCourse', 'testBuilding2', 'testRoom2', '2023-01-03 15:55:00', '2023-01-03 17:56:00'),
(31, 'Test Student1', 'testCourse', 'testBuilding1', 'testRoom1', '2023-01-08 04:06:00', '2023-01-08 05:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` enum('admin','faculty','student','') NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `allowance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `user_type`, `full_name`, `contact_number`, `email`, `course`, `allowance`) VALUES
(13, 'superadmin', '202cb962ac59075b964b07152d234b70', 'admin', 'Super Admin', '09098765765', 'super@admin.com', 'Administrator', 1),
(36, 'teststudent1', '81dc9bdb52d04dc20036dbd8313ed055', 'student', 'Test Student1', '0900STUDENT1', 'testEmail1@student.com', 'testCourse', 2),
(37, 'teststudent2', '202cb962ac59075b964b07152d234b70', 'student', 'Test Student2', '0900STUDENT2', 'testEmail2@student.com', 'testCourse', 12),
(38, 'teststudent3', '202cb962ac59075b964b07152d234b70', 'student', 'Test Student3', '0900STUDENT3', 'testEmail3@student.com', 'testCourse', 19),
(39, 'testfaculty1', '202cb962ac59075b964b07152d234b70', 'faculty', 'Test Faculty1', '0900FACULTY1', 'testEmail1@faculty.com', 'Faculty', 1),
(40, 'testfaculty2', '202cb962ac59075b964b07152d234b70', 'faculty', 'Test Faculty2', '0900FACULTY2', 'testEmail2@faculty.com', 'Faculty', 1),
(41, 'testfaculty3', '202cb962ac59075b964b07152d234b70', 'faculty', 'Test Faculty3', '0900FACULTY3', 'testEmail3@faculty.com', 'Faculty', 1),
(42, 'testadmin1', '202cb962ac59075b964b07152d234b70', 'admin', 'Test Admin1', '0900ADMIN1', 'testEmail1@admin.com', 'Administrator', 1),
(43, 'testadmin2', '202cb962ac59075b964b07152d234b70', 'admin', 'Test Admin2', '0900ADMIN2', 'testEmail2@admin.com', 'Administrator', 1),
(44, 'testadmin3', '202cb962ac59075b964b07152d234b70', 'admin', 'Test Admin3', '0900ADMIN3', 'testEmail3@admin.com', 'Administrator', 1);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
