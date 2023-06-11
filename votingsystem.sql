-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 11, 2023 at 02:49 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `username` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`username`, `Password`) VALUES
('admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7'),
('admin2', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8');

-- --------------------------------------------------------

--
-- Table structure for table `candidates_info`
--

DROP TABLE IF EXISTS `candidates_info`;
CREATE TABLE IF NOT EXISTS `candidates_info` (
  `full_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `citizenship` int NOT NULL,
  `contact` int NOT NULL,
  `Candidate_id` int NOT NULL AUTO_INCREMENT,
  `Age` int NOT NULL,
  `Father` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `symbol` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `election_id` int NOT NULL,
  PRIMARY KEY (`Candidate_id`),
  UNIQUE KEY `citizenship` (`citizenship`,`Candidate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10040 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `candidates_info`
--

INSERT INTO `candidates_info` (`full_name`, `citizenship`, `contact`, `Candidate_id`, `Age`, `Father`, `address`, `symbol`, `election_id`) VALUES
('Joshep Cardos', 2147483647, 2147483647, 10039, 41, 'Rick Cardos', 'Kathmandu', 'candidateimage/Joshep Cardos.png', 1039),
('Rohan Shrestha', 2147483647, 2147483647, 10037, 31, 'Sohan Shrestha', 'Bhaktapur', 'candidateimage/Rohan Shrestha.jpg', 1039);

-- --------------------------------------------------------

--
-- Table structure for table `elections`
--

DROP TABLE IF EXISTS `elections`;
CREATE TABLE IF NOT EXISTS `elections` (
  `Election_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Post_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `election_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`election_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1040 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `elections`
--

INSERT INTO `elections` (`Election_name`, `Post_name`, `election_id`) VALUES
('Election-1', 'President', 1039);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `fullname` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `citizenship` bigint NOT NULL,
  `dob` date NOT NULL,
  `phone` bigint NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `profilepic` varchar(255) COLLATE utf8mb4_bin DEFAULT NULL,
  PRIMARY KEY (`citizenship`),
  UNIQUE KEY `phone` (`phone`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`fullname`, `citizenship`, `dob`, `phone`, `email`, `password`, `father_name`, `address`, `profilepic`) VALUES
('Nischal Wayaju', 1111, '2003-01-12', 9840256311, 'nischalwayaju2000@gmail.com', '0ffe1abd1a08215353c233d6e009613e95eec4253832a761af28ff37ac5a150c', 'Raj Kumar Wayaju', 'Bhaktapur', 'profileimages/Nischal Wayaju.jpg'),
('Krish Prajapati', 2222, '2023-01-01', 9800000000, 'krishparajapati@gmail.com', 'edee29f882543b956620b26d0ee0e7e950399b1c4222f5de05e06425b4c995e9', 'fdfhdjfhkdkfd', 'bhakrapur', NULL),
('Prashanna Maharjan', 10011, '2000-01-01', 9811111111, 'prashannamaharjan@gmail.com', 'ddf3ff7c110ced585a4061e3a3c66f7051fe6847fd4b561f03bbad2b072a9cf0', 'Ram Maharjan', 'Lalitpur', 'profileimages/Prashanna Mahrajan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `fullname` text COLLATE utf8mb4_bin NOT NULL,
  `citizenship` bigint NOT NULL,
  `dob` date NOT NULL,
  `user-id` int NOT NULL AUTO_INCREMENT,
  `phone` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`user-id`),
  UNIQUE KEY `citizenship` (`citizenship`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=MyISAM AUTO_INCREMENT=1015 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`fullname`, `citizenship`, `dob`, `user-id`, `phone`) VALUES
('Nischal Wayaju', 22017700502, '2003-01-12', 1010, 9840256311),
('Alish Magaju', 12345, '2000-01-01', 1011, 9744253368),
('Krish Prajapati', 2222, '2023-01-01', 1012, 9800000000),
('Prashanna Maharjan', 10011, '2000-01-01', 1014, 9811111111);

-- --------------------------------------------------------

--
-- Table structure for table `voter_votes`
--

DROP TABLE IF EXISTS `voter_votes`;
CREATE TABLE IF NOT EXISTS `voter_votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `citizenship` int NOT NULL,
  `candidate_id` int NOT NULL,
  `election_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_voter_votes_voter_id` (`citizenship`),
  KEY `fk_voter_votes_candidate_id` (`candidate_id`),
  KEY `fk_voter_votes_election_id` (`election_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `voter_votes`
--

INSERT INTO `voter_votes` (`id`, `citizenship`, `candidate_id`, `election_id`) VALUES
(15, 1111, 10033, 1035),
(17, 5555, 10033, 1035),
(18, 1111, 10039, 1039),
(19, 10011, 10039, 1039);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
