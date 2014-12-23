-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2014 at 05:02 PM
-- Server version: 5.6.20
-- PHP Version: 5.3.29

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `subTask`
--

INSERT INTO `subTask` (`task_id`, `sub_id`, `sub_parent`, `name`, `content`, `type`, `weight`, `order`) VALUES
(1, 1, 0, '', '{ "q0":"cheese", "q1":"cheese", "q2":"true" }', 'a', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
`task_id` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `detail` text COLLATE utf8_bin NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `name`, `detail`, `type`) VALUES
(1, 'Test Quiz', '[	{		question: "What is the meaning of life?",		answers: ["fun", "suffer", "cheese"],		correct: "cheese"	},{		question: "What is most important?",		answers: ["eat, pray, love", "work, sleep, study", "cheese"],		correct: "cheese"	},{		question: "Seattle is Rainy?",		answers: ["true", "false"],		correct: "true"	}]', 'q');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subTask`
--
ALTER TABLE `subTask`
MODIFY `sub_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
MODIFY `task_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
