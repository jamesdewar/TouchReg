-- This database was used to test connection between the arduino and the primary database
-- Most of the code is the same with a few tweaks to simplify the process


-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2015 at 05:23 AM
-- Server version: 5.1.71
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ma301wm_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendance`
--

CREATE TABLE IF NOT EXISTS `Attendance` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  KEY `timestamp` (`timestamp`),
  KEY `course_id` (`course_id`,`student_id`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Attendance`
--

INSERT INTO `Attendance` (`course_id`, `student_id`, `timestamp`) VALUES
(1, 1, '2015-03-27 05:22:36'),
(1, 2, '2015-03-27 04:58:56'),
(1, 2, '2015-03-27 04:58:59'),
(1, 2, '2015-03-27 04:59:01'),
(1, 2, '2015-03-27 04:59:37'),
(1, 2, '2015-03-27 05:00:09'),
(1, 3, '2015-03-27 05:22:29'),
(1, 8, '2015-03-27 05:22:39'),
(1, 10, '2015-03-27 05:07:42'),
(1, 11, '2015-03-27 05:22:40'),
(5, 6, '2015-03-27 05:22:30'),
(5, 7, '2015-03-27 05:22:35'),
(5, 9, '2015-03-27 05:22:32');

-- --------------------------------------------------------

--
-- Table structure for table `Courses`
--

CREATE TABLE IF NOT EXISTS `Courses` (
  `Course_id` int(11) NOT NULL,
  `Course_Name` varchar(50) DEFAULT NULL,
  `Student_enlisted` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Courses`
--

INSERT INTO `Courses` (`Course_id`, `Course_Name`, `Student_enlisted`) VALUES
(1, 'Intro to Programming', '1 2 3 8 11 12 10 14 15 16'),
(2, 'Databases', '2 4 5 7 10 12 13'),
(3, 'Machine Learning', '1 3 8 10 11 12 14 15 16'),
(4, 'Artificial Intellegence', '2 4 5 9 11 12 13 16'),
(5, 'Audio-Visual Computing''', '1 5 6 7 8 9 12 13 15 16');

-- --------------------------------------------------------

--
-- Table structure for table `output`
--

CREATE TABLE IF NOT EXISTS `output` (
  `dump` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `output`
--

INSERT INTO `output` (`dump`) VALUES
('student ID not found'),
('Received cid = 04 CD E1 EA BC 2B 80 and room = 5. student id is 2 and courses are 1 2 4. The Student is in this course (5).');

-- --------------------------------------------------------

--
-- Table structure for table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `cardID` varchar(255) NOT NULL,
  `Student_ID` int(40) DEFAULT NULL,
  `First_Name` varchar(40) DEFAULT NULL,
  `Last_Name` varchar(40) DEFAULT NULL,
  `Course_ID` varchar(100) DEFAULT NULL,
  UNIQUE KEY `cardID` (`cardID`),
  UNIQUE KEY `Student_ID` (`Student_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`cardID`, `Student_ID`, `First_Name`, `Last_Name`, `Course_ID`) VALUES
('D1 B1 67 C0', 1, 'James', 'Dewar', '1 3 5'),
('71 C7 A6 C0', 3, 'Alan', 'Turing', '1 3'),
('04 CD E1 EA BC 2B 80', 2, 'William', 'Moore', '1 2 4'),
('01 0B A1 C0', 4, 'Peter', 'Dinklage', '2 4'),
('C1 43 2B BE', 5, 'Robin', 'Hood', '4 5'),
('01 4E C3 C0', 6, 'Peter', 'Johns', '5'),
('31 5B 3D C0', 7, 'James', 'Potter', '2 5'),
('01 53 3E C0', 8, 'Richard', 'Bard', '1 3 5'),
('41 73 95 C0', 9, 'Kate', 'Devlin', '2 4 5'),
('C1 DF 97 C0', 11, 'Nicolas', 'Chocolat', '3 4 1'),
('D1 82 CD C0', 10, 'Barack', 'Obama', '1 2 3');

-- --------------------------------------------------------

--
-- Table structure for table `Timetable`
--

CREATE TABLE IF NOT EXISTS `Timetable` (
  `course_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `time_in` datetime NOT NULL,
  `time_out` datetime NOT NULL,
  KEY `course_id` (`course_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Timetable`
--

INSERT INTO `Timetable` (`course_id`, `room_id`, `time_in`, `time_out`) VALUES
(1, 1, '2015-03-09 09:00:00', '2015-03-09 12:00:00'),
(1, 1, '2015-03-16 09:00:00', '2015-03-16 12:00:00'),
(1, 1, '2015-03-23 09:00:00', '2015-03-23 12:00:00'),
(1, 1, '2015-03-30 09:00:00', '2015-03-30 12:00:00'),
(1, 1, '2015-04-06 09:00:00', '2015-04-06 12:00:00'),
(2, 2, '2015-03-10 11:00:00', '2015-03-10 13:00:00'),
(2, 2, '2015-03-17 11:00:00', '2015-03-17 13:00:00'),
(2, 2, '2015-03-24 11:00:00', '2015-03-24 13:00:00'),
(2, 2, '2015-03-31 11:00:00', '2015-03-31 13:00:00'),
(2, 2, '2015-04-07 11:00:00', '2015-04-07 13:00:00'),
(3, 3, '2015-03-11 13:00:00', '2015-03-11 17:00:00'),
(3, 3, '2015-03-18 13:00:00', '2015-03-18 17:00:00'),
(3, 3, '2015-03-25 13:00:00', '2015-03-25 17:00:00'),
(3, 3, '2015-04-01 13:00:00', '2015-04-01 17:00:00'),
(3, 3, '2015-04-08 13:00:00', '2015-04-08 17:00:00'),
(4, 4, '2015-03-13 09:00:00', '2015-03-13 12:00:00'),
(4, 4, '2015-03-20 09:00:00', '2015-03-20 12:00:00'),
(4, 4, '2015-03-27 09:00:00', '2015-03-27 12:00:00'),
(4, 4, '2015-04-03 09:00:00', '2015-04-03 12:00:00'),
(4, 4, '2015-04-10 09:00:00', '2015-04-10 12:00:00'),
(5, 5, '2015-03-10 14:00:00', '2015-03-10 15:00:00'),
(5, 5, '2015-03-17 14:00:00', '2015-03-17 15:00:00'),
(5, 5, '2015-03-24 14:00:00', '2015-03-24 15:00:00'),
(5, 5, '2015-03-31 14:00:00', '2015-03-31 15:00:00'),
(5, 5, '2015-04-07 14:00:00', '2015-04-07 15:00:00'),
(1, 5, '2015-03-27 05:00:00', '2015-03-27 23:59:00'),
(5, 5, '2015-03-27 05:00:00', '2015-03-26 23:59:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
