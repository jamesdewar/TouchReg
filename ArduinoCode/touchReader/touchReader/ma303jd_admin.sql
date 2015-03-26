-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 25, 2015 at 01:25 PM
-- Server version: 5.1.71
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ma303jd_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `Attendance`
--

CREATE TABLE IF NOT EXISTS `Attendance` (
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  KEY `timestamp` (`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Attendance`
--

INSERT INTO `Attendance` (`course_id`, `student_id`, `timestamp`) VALUES
(1, 1, '2015-03-09 09:03:00'),
(1, 2, '2015-03-09 09:03:00'),
(1, 8, '2015-03-09 09:03:00'),
(1, 11, '2015-03-09 09:03:00'),
(1, 10, '2015-03-09 09:03:00'),
(1, 14, '2015-03-09 09:03:00'),
(1, 16, '2015-03-09 09:03:00'),
(2, 2, '2015-03-10 11:02:00'),
(2, 5, '2015-03-10 11:02:00'),
(2, 7, '2015-03-10 11:02:00'),
(3, 1, '2015-03-11 13:04:00'),
(3, 8, '2015-03-11 13:04:00'),
(3, 14, '2015-03-11 13:04:00'),
(3, 16, '2015-03-11 13:04:00'),
(4, 2, '2015-03-13 09:05:00'),
(4, 5, '2015-03-13 09:05:00'),
(4, 9, '2015-03-13 09:05:00'),
(4, 11, '2015-03-13 09:05:00'),
(4, 13, '2015-03-13 09:05:00'),
(4, 16, '2015-03-13 09:05:00'),
(5, 1, '2015-03-17 14:04:00'),
(5, 6, '2015-03-10 14:04:00'),
(5, 7, '2015-03-10 14:04:00'),
(5, 9, '2015-03-10 14:04:00'),
(5, 13, '2015-03-10 14:04:00'),
(5, 15, '2015-03-10 14:04:00'),
(5, 16, '2015-03-10 14:04:00'),
(1, 1, '2015-03-16 09:04:00'),
(1, 2, '2015-03-16 09:04:55'),
(1, 8, '2015-03-16 09:04:10'),
(1, 11, '2015-03-16 09:04:00'),
(1, 12, '2015-03-16 09:04:00'),
(1, 10, '2015-03-16 09:04:00'),
(1, 14, '2015-03-16 09:04:00'),
(1, 15, '2015-03-16 09:04:00'),
(1, 16, '2015-03-16 09:04:00'),
(2, 4, '2015-03-17 11:03:00'),
(2, 5, '2015-03-17 11:03:00'),
(2, 7, '2015-03-17 11:03:00'),
(2, 9, '2015-03-17 11:03:00'),
(2, 12, '2015-03-17 11:03:00'),
(3, 1, '2015-03-18 13:02:00'),
(3, 8, '2015-03-18 13:02:00'),
(3, 10, '2015-03-18 13:02:00'),
(3, 14, '2015-03-18 13:02:00'),
(3, 16, '2015-03-18 13:02:00'),
(4, 2, '2015-03-20 09:07:00'),
(4, 9, '2015-03-20 09:07:00'),
(5, 1, '2015-03-10 14:04:00'),
(5, 5, '2015-03-10 14:04:00'),
(5, 6, '2015-03-10 14:04:00'),
(5, 8, '2015-03-10 14:04:00'),
(5, 12, '2015-03-10 14:04:00'),
(5, 13, '2015-03-10 14:04:00'),
(5, 16, '2015-03-10 14:04:00'),
(1, 2, '2015-03-23 09:06:00'),
(1, 3, '2015-03-23 09:06:00'),
(1, 10, '2015-03-23 09:06:00'),
(1, 14, '2015-03-23 09:06:00'),
(1, 16, '2015-03-23 09:06:00'),
(2, 4, '2015-03-24 11:02:00'),
(2, 7, '2015-03-24 11:02:00'),
(2, 9, '2015-03-24 11:02:00'),
(2, 12, '2015-03-24 11:02:00'),
(3, 8, '2015-03-25 13:08:00'),
(3, 10, '2015-03-25 13:08:00'),
(3, 11, '2015-03-25 13:08:00'),
(3, 14, '2015-03-25 13:08:00'),
(3, 15, '2015-03-25 13:08:00'),
(4, 2, '2015-03-27 10:00:00'),
(4, 5, '2015-03-27 10:00:00'),
(4, 9, '2015-03-27 10:00:00'),
(4, 11, '2015-03-27 10:00:00'),
(4, 13, '2015-03-27 10:00:00'),
(5, 5, '2015-03-23 14:03:00'),
(5, 6, '2015-03-23 14:03:00'),
(5, 7, '2015-03-23 14:03:00'),
(5, 9, '2015-03-23 14:03:00'),
(5, 16, '2015-03-23 14:03:00');

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
-- Table structure for table `Students`
--

CREATE TABLE IF NOT EXISTS `Students` (
  `Student_ID` int(40) NOT NULL,
  `First_Name` varchar(40) NOT NULL,
  `Last_Name` varchar(40) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Course_ID` varchar(100) NOT NULL,
  `Attendance_ID` varchar(255) NOT NULL,
  KEY `Student_ID` (`Student_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Students`
--

INSERT INTO `Students` (`Student_ID`, `First_Name`, `Last_Name`, `Address`, `Course_ID`, `Attendance_ID`) VALUES
(1, 'James', 'Dewar', '123 BOB Street', '1 3 5 ', ''),
(2, 'William', 'Moore', '12 pop road', '1 2 4', ''),
(3, 'Alan', 'Turing', '12 treat way', '1 3', ''),
(4, 'Peter', 'Dinklage', '2 short street', '2 4', ''),
(5, 'Robin', 'Hood', '3 fairytale mews', '4 5', ''),
(6, 'Peter', 'Johns', '3 hello way', '5', ''),
(7, 'James', 'Potter', '8 kakuma way', '2 5', ''),
(8, 'Richard', 'Bard', '2 way', '1 3 5', ''),
(9, 'Kate', 'Devlin', '3 gold avenue', '2 4 5', ''),
(11, 'Nicolas', 'Chocolat', '3 Paris way', '3 4 1', ''),
(10, 'Barack', 'Obama', '4 karen road', '1 2 3', ''),
(12, 'Jesus', 'Christ', '10 Bethlehem dead end', '1 2 3 4 5', ''),
(13, 'Judas', 'Traitor', '4 traitor Street', '4 5 2', ''),
(14, 'John', 'Lewis', '2 stratford', '1 3', ''),
(16, 'Louise', 'Beveridge', '4 pilot way', '3 4 1 5', ''),
(15, 'Drag', 'Queen', '34 trans way', '1 3 5', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
  `FirstName` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_list` varchar(255) NOT NULL,
  KEY `FirstName` (`FirstName`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`FirstName`, `Surname`, `Email`, `password`, `course_list`) VALUES
('James', 'Dewar', 'ma303jd@gold.ac.uk', 'ma303jd', '1'),
('William', 'Moore', 'ma202jd@igor.gold.ac.uk', 'ma202jd', '4'),
('Emma', 'Watson', 'ma101jd@igor.gold.ac.uk', 'ma101jd', '2 3'),
('Bryan', 'Cranston', 'ma404jd@igor.gold.ac.uk', 'ma404jd', '5');

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
(5, 5, '2015-04-07 14:00:00', '2015-04-07 15:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
