-- phpMyAdmin SQL Dump
-- version 4.4.6.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2015 at 04:33 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lms_content`
--

-- --------------------------------------------------------

--
-- Table structure for table `active_login`
--

CREATE TABLE IF NOT EXISTS `active_login` (
  `id` int(11) NOT NULL,
  `username` char(15) COLLATE utf8mb4_bin NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `active_login`
--

INSERT INTO `active_login` (`id`, `username`, `token`, `login_time`) VALUES
(1, 'test', 'Á;ò‚`6n¿ÛrEi‹¾Þ', '2015-07-19 04:25:45'),
(2, 'test', '½ŽópGÕd-ç¯lk)|)', '2015-07-19 04:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `class_enroll`
--

CREATE TABLE IF NOT EXISTS `class_enroll` (
  `id_course` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type` char(1) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `class_enroll`
--

INSERT INTO `class_enroll` (`id_course`, `id_user`, `type`) VALUES
(1, 1, 't');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id_course` int(11) NOT NULL,
  `course_name` varchar(256) COLLATE utf8mb4_bin NOT NULL,
  `level` int(11) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id_course`, `course_name`, `level`, `creator_id`, `school_id`) VALUES
(1, 'Introduction to Programming', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subTask`
--

CREATE TABLE IF NOT EXISTS `subTask` (
  `task_id` int(255) NOT NULL,
  `sub_id` int(255) NOT NULL,
  `sub_parent` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `type` char(5) COLLATE utf8_bin NOT NULL,
  `weight` int(255) NOT NULL,
  `order` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `subTask`
--

INSERT INTO `subTask` (`task_id`, `sub_id`, `sub_parent`, `name`, `content`, `type`, `weight`, `order`) VALUES
(1, 1, 0, '', '{ "q0":"cheese", "q1":"cheese", "q2":"true" }', 'a', 0, 0),
(2, 2, 0, 'Test 2', '[{"qName":"Test 2"},"church","true",["Bob","Day","Hendrix","Dylan"]]', 'a', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `detail` text COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_course` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `name`, `detail`, `type`, `id_course`) VALUES
(1, 'Test 2', '[{"qName":"Test 2"},{"category":"mc","question":"What is the meaning of life?","answer":["beer","food","church","work"]},{"category":"tf","question":"Life is good?","answer":["true","false"]},{"category":"ma","question":["Jim","Work","Jimmy","Bob"],"answer":["Bob","Day","Hendrix","Dylan"]}]', 'q', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `username` char(15) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(80) COLLATE utf8mb4_bin NOT NULL,
  `role` int(11) NOT NULL,
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `username`, `password`, `email`, `role`, `date_joined`) VALUES
(1, 'test', 'test', 'test', '$2y$10$ak6teWDCnffqSY13ZNIVGOwR5Em1F6NtJmI2D9HXxaJLoOcO6eOBm', 'test@test.edu', 1, '2015-07-19 04:15:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `active_login`
--
ALTER TABLE `active_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- Indexes for table `subTask`
--
ALTER TABLE `subTask`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `active_login`
--
ALTER TABLE `active_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id_course` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `subTask`
--
ALTER TABLE `subTask`
  MODIFY `sub_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
